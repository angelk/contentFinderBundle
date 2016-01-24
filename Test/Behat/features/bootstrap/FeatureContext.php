<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Path to the temporary directory where test files are created
     * @var string
     */
    protected $filesTempDir;
    /**
     * Path to symfony
     * @var string
     */
    protected $symfonyPath;
    /**
     * Output of last executed search command
     * @var array
     */
    protected $consoleOutput;
    
    /**
     * Command to execute
     * @var string
     */
    protected $commandName;

    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->filesTempDir = __DIR__ . DIRECTORY_SEPARATOR  . '..'
                . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'tmp';
        $this->symfonyPath = __DIR__ . DIRECTORY_SEPARATOR  . '..'
                . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'symfony';
        $this->commandName = 'potaka:search';
    }
    
    /**
     * @BeforeScenario
     */
     public function beforeScenario()
     {
         $filesystem = new Filesystem();
         if ($filesystem->exists($this->filesTempDir)) {
            $filesystem->remove($this->filesTempDir);
         }
         
     }
    
    /**
     * @Given There is file named :file with content :content
     */
    public function thereIsFileNamedWithContent($file, $content)
    {
        $filePath = $this->filesTempDir . DIRECTORY_SEPARATOR . $file;
        $this->createFileRecursive($filePath, $content);
    }
    
    /**
     * @When I search for file having content :arg1
     */
    public function iSearchForFileHavingContent($content)
    {
        $this->executeFindCommand(
            // this should be configurable!
            'simpleSearchAndFinderAdapter',
            $this->filesTempDir,
            $content
        );
    }

    /**
     * @Then I should see file :arg1
     */
    public function iShouldSeeFile($filename)
    {
        $fileNameRegexpEscaped = preg_quote($filename, '/');
        if (!preg_match("/$fileNameRegexpEscaped/", $this->getOutputAsString())) {
            throw new \Exception("Expected file not found");
        }
    }
    
    /**
     * @Then I should not see file :arg1
     */
    public function iShouldNotSeeFile($filename)
    {
        try {
            $this->iShouldSeeFile($filename);
        } catch (Exception $ex) {
            // file is not found, it's ok
            return true;
        }
        
        throw new \Exception('Expected to not found the file');
    }


    
    protected function createFileRecursive($filepath, $content = null)
    {
        $splFile = new \SplFileInfo($filepath);
        $filesystem = new Filesystem();
        $filesystem->mkdir($splFile->getPath());
        file_put_contents($filepath, $content);
    }
    
    protected function executeFindCommand($service, $location, $content)
    {
        $consolePath = $this->symfonyPath . DIRECTORY_SEPARATOR
                        . 'app' . DIRECTORY_SEPARATOR . 'console'
                        . " {$this->commandName} {$service}"
                        . " {$location} {$content}";
        $output = null;
        exec($consolePath, $output);
        $this->consoleOutput = $output;
    }
    
    protected function getOutputAsString()
    {
        $return = implode(PHP_EOL, $this->consoleOutput);
        return $return;
    }
}
