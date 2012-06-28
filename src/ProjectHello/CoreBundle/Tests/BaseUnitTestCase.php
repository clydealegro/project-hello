<?php

namespace ProjectHello\CoreBundle\Tests;

use Doctrine\Tests\OrmTestCase;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

/**
 * This class implements how Symfony2 unit tests
 *
 * @author Nherrisa Mae U. Celeste <nherrisa.celeste@goabroad.com>
 * @since  June 27, 2012
 */
class BaseUnitTestCase extends OrmTestCase
{
    private $entityManager;

    /**
     * Overrides setUp() from PHPUnit_Framework_TestCase
     */
    protected function setUp()
    {
        $reader = new AnnotationReader();
        $reader->setIgnoreNotImportedAnnotations(true);
        $reader->setEnableParsePhpImports(true);

        $metadataDriver = new AnnotationDriver($reader, 'ProjectHello\\CoreBundle\\Entity');

        $this->entityManager = $this->_getTestEntityManager();
        $configuration = $this->entityManager->getConfiguration();

        $configuration->setMetadataDriverImpl($metadataDriver);
        $configuration->setEntityNamespaces(array('ProjectHelloCoreBundle' => 'ProjectHello\\CoreBundle\\Entity'));
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
     * Overrides tearDown() from PHPUnit_Framework_TestCase
     */
    protected function tearDown()
    {
        $this->entityManager = null;
    }
}