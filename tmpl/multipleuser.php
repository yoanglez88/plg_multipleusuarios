<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

$value = $field->value;

if ($value == '') {
	return;
}
?>
<h1><?php echo JHtml::_('content.prepare', $value); ?></h1>
