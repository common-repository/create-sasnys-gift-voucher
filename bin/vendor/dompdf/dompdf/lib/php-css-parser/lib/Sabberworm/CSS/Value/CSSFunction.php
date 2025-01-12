<?php

namespace schweikert\CSS\Value;

class CSSFunction extends ValueList {

	private $sName;

	public function __construct($sName, $aArguments, $sSeparator = ',', $iLineNo = 0) {
		if($aArguments instanceof RuleValueList) {
			$sSeparator = $aArguments->getListSeparator();
			$aArguments = $aArguments->getListComponents();
		}
		$this->sName = $sName;
		$this->iLineNo = $iLineNo;
		parent::__construct($aArguments, $sSeparator, $iLineNo);
	}

	public function getName() {
		return $this->sName;
	}

	public function setName($sName) {
		$this->sName = $sName;
	}

	public function getArguments() {
		return $this->aComponents;
	}

	public function __toString() {
		return $this->render(new \schweikert\CSS\OutputFormat());
	}

	public function render(\schweikert\CSS\OutputFormat $oOutputFormat) {
		$aArguments = parent::render($oOutputFormat);
		return "{$this->sName}({$aArguments})";
	}

}