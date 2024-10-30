<?php

namespace schweikert\CSS;

interface Renderable {
	public function __toString();
	public function render(\schweikert\CSS\OutputFormat $oOutputFormat);
	public function getLineNo();
}