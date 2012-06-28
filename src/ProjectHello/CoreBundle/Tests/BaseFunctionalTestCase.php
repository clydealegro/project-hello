<?php

namespace ProjectHello\CoreBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

require_once(__DIR__.'/../../../../app/AppKernel.php');

/**
 * This class implements the functional tests of each entity by connecting
 *  to the database to retrieve an actual result set
 *
 * @author Nherrisa Mae U. Celeste <nherrisa.celeste@goabroad.com>
 * @since  June 27, 2012
 */
class BaseFunctionalTestCase extends \PHPUnit_Framework_TestCase
{
    private $kernel;
    private $application;
    private $entityManager;

    /**
     * Overrides setUp() from PHPUnit_Framework_TestCase
     */
    protected function setUp()
    {
        $this->kernel = new \AppKernel('test', true);
        $this->kernel->boot();

        $this->entityManager = $this->kernel->getContainer()->get('doctrine.orm.entity_manager');

        $this->application = new Application($this->kernel);
        $this->registerCommands($this->kernel, $this->application);
        $this->application->setAutoExit(false);

        $this->runConsole("doctrine:schema:drop", array("--force" => true));
        $this->runConsole("doctrine:schema:create");
    }

    /**
     * Gets the kernel for the test environment
     *
     * @return AppKernel
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * Gets the entity manager for the test environment
     *
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Registers commands for each bundle in the kernel for test environment
     *
     * @param AppKernel   $kernel      The kernel in the test environment
     * @param Application $application The application for the test environment
     */
    protected function registerCommands($kernel, $application)
    {
        $kernel->boot();

        foreach ($kernel->getBundles() as $bundle) {
            $bundle->registerCommands($application);
        }
    }

    /**
     * Runs console commands
     *
     * @param string $command The console command to run
     * @param array  $options The arguments needed to run the command
     *
     * @return integer 0 if everything went fine, or an error code
     */
    protected function runConsole($command, $options = array())
    {
        return $this->application->run(new ArrayInput(
            array_merge($options, array('command' => $command, '-e' => 'test', '-q' => null))
        ));
    }

    /**
     * Overrides tearDown() from PHPUnit_Framework_TestCase
     */
    protected function tearDown()
    {
        $this->kernel = null;
        $this->application = null;
        $this->entityManager = null;
    }
}