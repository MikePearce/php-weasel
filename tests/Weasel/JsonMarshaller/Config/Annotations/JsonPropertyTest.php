<?php
namespace Weasel\JsonMarshaller\Config\Annotations;

require_once(__DIR__ . '/../../../../WeaselAutoloader.php');

class JsonPropertyTest extends \PHPUnit_Framework_TestCase
{

    public function testParseClassAnnotations() {

        $annotationReader = new \Weasel\Annotation\AnnotationReader(new \ReflectionClass('\JsonMarshaller\Config\Annotations\JsonProperty'), new \Weasel\Annotation\AnnotationConfigurator());

        $expected = array(
            '\Annotation\Annotations\Annotation' => array(
                new \Weasel\Annotation\Annotations\Annotation(array("property", "method", '\JsonMarshaller\Config\Annotations\JsonCreator'), null)
            ),
        );

        $this->assertEquals($expected, $annotationReader->getClassAnnotations());

    }

    public function testParsePropertyAnnotations() {

        $rClass = new \ReflectionClass('\JsonMarshaller\Config\Annotations\JsonProperty');
        $annotationReader = new \Weasel\Annotation\AnnotationReader($rClass, new \Weasel\Annotation\AnnotationConfigurator());


        $found = array();
        foreach ($rClass->getProperties() as $property) {
            $name = $property->getName();
            $found[$name] = $annotationReader->getPropertyAnnotations($name);
        }

        $this->assertEquals(array("name" => array(), "type" => array()), $found);

    }

    public function testParseMethodAnnotations() {

        $rClass = new \ReflectionClass('\JsonMarshaller\Config\Annotations\JsonProperty');
        $annotationReader = new \Weasel\Annotation\AnnotationReader($rClass, new \Weasel\Annotation\AnnotationConfigurator());

        $found = array();
        foreach ($rClass->getMethods() as $method) {
            /**
             * @var \ReflectionMethod $method
             */
            $name = $method->getName();
            $found[$name] = $annotationReader->getMethodAnnotations($name);
        }

        $expected = array("__construct" =>
            array('\Annotation\Annotations\AnnotationCreator' => array(
                new \Weasel\Annotation\Annotations\AnnotationCreator(
                    array(
                        new \Weasel\Annotation\Annotations\Parameter("name", 'string', false),
                        new \Weasel\Annotation\Annotations\Parameter("type", 'string', false),
                    )
                )
            )),
            'getName' => array(),
            'getType' => array(),
        );

        $this->assertEquals($expected, $found);

    }

    public function testCreate() {
        $test = new JsonProperty("foo", "bar");
        $this->assertEquals("foo", $test->getName());
        $this->assertEquals("bar", $test->getType());
    }
}