<?php defined('_JEXEC') or die;
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

JLoader::import('components.com_fields.libraries.fieldsplugin', JPATH_ADMINISTRATOR);

/**
 * Fields Editor Plugin
 *
 * @since  3.7.0
 */
class PlgFieldsMultipleuser extends FieldsPlugin
{
	/**
	 * Transforms the field into a DOM XML element and appends it as a child on the given parent.
	 *
	 * @param   stdClass   $field  The field.
	 * @param   DOMElement $parent The field node parent.
	 * @param   JForm      $form   The form.
	 *
	 * @return  DOMElement
	 *
	 * @since   3.7.0
	 */
	public function onCustomFieldsPrepareDom($field, DOMElement $parent, JForm $form)
	{
		// Load the custom JForm field, all the magic will happen there.
		$fieldNode = parent::onCustomFieldsPrepareDom($field, $parent, $form);

		if (!$fieldNode) {
			return $fieldNode;
		}

		$form->addFieldPath(JPATH_PLUGINS . '/fields/multipleuser/fields');
		$fieldNode->setAttribute('type', 'multipleuser');

		return $fieldNode;
	}

	/**
	 * Don't allow categories to be deleted if they contain items or subcategories with items
	 *
	 * @param   string $context The context for the content passed to the plugin.
	 * @param   object $data    The data relating to the content that was deleted.
	 *
	 * @return  boolean
	 *
	 * @since   1.6
	 */
	public function onContentBeforeDelete($context, $item)
	{
	}

	/**
	 * The delete event.
	 *
	 * @param   string   $context The context
	 * @param   stdClass $item    The item
	 *
	 * @return  boolean
	 *
	 * @since   3.7.0
	 */
	public function onContentAfterDelete($context, $item)
	{
	}

	/**
	 * Change the state in core_content if the state in a table is changed
	 *
	 * @param   string  $context The context for the content passed to the plugin.
	 * @param   array   $pks     A list of primary key ids of the content that has changed state.
	 * @param   integer $value   The value of the state that the content has been changed to.
	 *
	 * @return  boolean
	 *
	 * @since   3.1
	 */
	public function onContentChangeState($context, $pks, $value)
	{
	}

	/**
	 * Example after save content method
	 * Article is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved
	 *
	 * @param   string  $context The context of the content passed to the plugin (added in 1.6)
	 * @param   object  $article A JTableContent object
	 * @param   boolean $isNew   If the content is just about to be created
	 *
	 * @return  boolean   true if function not enabled, is in frontend or is new. Else true or
	 *                    false depending on success of save function.
	 *
	 * @since   1.6
	 */
	public function onContentAfterSave($context, $item, $isNew, $data = array())
	{
	}

	/**
	 * The save event.
	 *
	 * @param   string  $context The context
	 * @param   JTable  $item    The table
	 * @param   boolean $isNew   Is new item
	 * @param   array   $data    The validated data
	 *
	 * @return  boolean
	 *
	 * @since   3.7.0
	 */
	public function onContentBeforeSave($context, $item, $isNew, $data = array())
	{
	}
}
