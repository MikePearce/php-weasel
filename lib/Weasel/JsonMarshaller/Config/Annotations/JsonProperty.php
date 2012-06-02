<?php
namespace Weasel\JsonMarshaller\Config\Annotations;

use Weasel\Annotation\Annotations\Annotation;
use Weasel\Annotation\Annotations\AnnotationCreator;
use Weasel\Annotation\Annotations\Parameter;

/**
 * Sets a property up to be serialized/deserialized explicitly.
 * The name sets the json field name to use for this property.
 * The type specifies the type to use.
 * Because PHP is not strongly typed we can only make best guesses about types if you do not provide type info!
 * @Annotation(on={"property", "method", "\JsonMarshaller\Config\Annotations\JsonCreator"})
 */
class JsonProperty
{

    protected $name;
    protected $type;

    /**
     * @param string $name
     * @param string $type
     * @AnnotationCreator({@Parameter(name="name", type="string", required=false), @Parameter(name="type", type="string", required=false)})
     */
    public function __construct($name, $type)
    {
        $this->name = isset($name) ? $name : null;
        $this->type = isset($type) ? $type : "string";
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

}
