<?php
class ComparedNaturalModuleInformation
{
	const EMPTY_SIGN = 0;
	const SIGN_OK = 1;
	const SIGN_NEXT_STEP = 2;
	const SIGN_CREATE = 3;
	const SIGN_CREATE_AND_NEXT_STEP = 4;
	const SIGN_ERROR = 5;
	
	private $naturalModuleInformations = array();
	
	public static function environments()
	{
		return array("ENTW", "SVNENTW", "QS", "PROD");
	}
	
	public static function signOrder()
	{
		return array(self::SIGN_ERROR, self::SIGN_NEXT_STEP, self::SIGN_CREATE_AND_NEXT_STEP, self::SIGN_CREATE, self::SIGN_OK);
	}

	public function __construct(array $naturalInformations)
	{
		$this->allocateModulesToEnvironments($naturalInformations);
		$this->allocateEmptyModulesToMissingEnvironments();
		$this->determineSourceSignsForAllEnvironments();		
	}

	private function allocateModulesToEnvironments(array $naturalInformations)
	{
		foreach ($naturalInformations as $naturalInformation)
		{
			$env = $naturalInformation->getEnvironmentName();
			if(in_array($env, self::environments()))
			{
				$this->naturalModuleInformations[array_search($env, self::environments())] = $naturalInformation;
			}
		}		
	}
	
	private function allocateEmptyModulesToMissingEnvironments()
	{
		if(array_key_exists(0, $this->naturalModuleInformations))
		{
			$this->naturalModuleInformations[0]->setSourceSign(self::SIGN_OK);
		}
		
		for($i = 0;$i < count(self::environments());$i++)
		{
			if(!array_key_exists($i, $this->naturalModuleInformations))
			{
				$environments = self::environments();
				$this->naturalModuleInformations[$i] = new EmptyNaturalModuleInformation($environments[$i]);
				$this->naturalModuleInformations[$i]->setSourceSign(self::SIGN_CREATE);
			}
		}
	}
	
	public function determineSourceSignsForAllEnvironments()
	{
		for($i = 1; $i < count(self::environments()); $i++)
		{
			$currentInformation = $this->naturalModuleInformations[$i];
			$previousInformation = $this->naturalModuleInformations[$i - 1];
			if($currentInformation->getSourceSign() <> self::SIGN_CREATE)
			{
				if($previousInformation->getSourceSign() <> self::SIGN_CREATE)
				{
					if($currentInformation->getHash() <> $previousInformation->getHash())
					{
						if($currentInformation->getSourceDate('YmdHis') > $previousInformation->getSourceDate('YmdHis'))
						{
							$currentInformation->setSourceSign(self::SIGN_ERROR);
						}
						else
						{
							$currentInformation->setSourceSign(self::SIGN_NEXT_STEP);
						}
					}
					else
					{
						$currentInformation->setSourceSign(self::SIGN_OK);
					}
				}
				else
				{
					$currentInformation->setSourceSign(self::SIGN_ERROR);
				}
			}
			elseif($previousInformation->getSourceSign() <> self::SIGN_CREATE && $previousInformation->getSourceSign() <> self::SIGN_CREATE_AND_NEXT_STEP)
			{
				$currentInformation->setSourceSign(self::SIGN_CREATE_AND_NEXT_STEP);
			}
		}
	}

	private function containsSourceSign($sign)
	{
		foreach($this->naturalModuleInformations as $information)
		{
			if($information->getSourceSign() == $sign)
			{
				return true;
			}
		}
		return false;
	}
	
	private function containsCatalogSign($sign)
	{
		foreach($this->naturalModuleInformations as $information)
		{
			if($information->getCatalogSign() == $sign)
			{
				return true;
			}
		}
		return false;
	}	
}
?>