<?php

namespace schweikert\CSS\Value;

abstract class PrimitiveValue extends Value {
    public function __construct($iLineNo = 0) {
        parent::__construct($iLineNo);
    }

}