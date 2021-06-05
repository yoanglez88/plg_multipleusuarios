<?php

defined('_JEXEC') or die;

$value = $field->value;

if ($value == '')
{
	return;
}

$value = (array) $value;
$texts = array();

foreach ($value as $userId)
{
	if (!$userId)
	{
		continue;
	}
	
	$texts[] = $userId;
}

echo htmlentities(implode(', ', $texts));
