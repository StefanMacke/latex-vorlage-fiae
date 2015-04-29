<?php
include(dirname(__FILE__).'/../bootstrap/Propel.php');

$t = new lime_test(13);

$t->comment('Empty Information');
$emptyComparedInformation = new ComparedNaturalModuleInformation(array());
$t->is($emptyComparedInformation->getCatalogSign(), ComparedNaturalModuleInformation::EMPTY_SIGN, 'Has no catalog sign');
$t->is($emptyComparedInformation->getSourceSign(), ComparedNaturalModuleInformation::SIGN_CREATE, 'Source has to be created');

$t->comment('Perfect Module');
$criteria = new Criteria();
$criteria->add(NaturalmodulenamePeer::NAME, 'SMTAB');
$moduleName = NaturalmodulenamePeer::doSelectOne($criteria);
$t->is($moduleName->getName(), 'SMTAB', 'Right modulename selected');
$comparedInformation = $moduleName->loadNaturalModuleInformation();
$t->is($comparedInformation->getSourceSign(), ComparedNaturalModuleInformation::SIGN_OK, 'Source sign shines global');
$t->is($comparedInformation->getCatalogSign(), ComparedNaturalModuleInformation::SIGN_OK, 'Catalog sign shines global');
$infos = $comparedInformation->getNaturalModuleInformations();
foreach($infos as $info)
{
	$env = $info->getEnvironmentName();
	$t->is($info->getSourceSign(), ComparedNaturalModuleInformation::SIGN_OK, 'Source sign shines at ' . $env);
	if($env != 'SVNENTW')
	{
		$t->is($info->getCatalogSign(), ComparedNaturalModuleInformation::SIGN_OK, 'Catalog sign shines at ' . $info->getEnvironmentName());
	}
	else
	{
		$t->is($info->getCatalogSign(), ComparedNaturalModuleInformation::EMPTY_SIGN, 'Catalog sign is empty at ' . $info->getEnvironmentName());
	}
}
?>