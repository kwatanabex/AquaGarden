<?php
/**
 * AdmFormsEl_menuフォームクラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class AdmFormsEl_menu extends SyL_AdmActionForm
{
/**
 * テーブルクラスの配列
 * 
 * @access protected
 * @var array
 */
var $table_classes = array (
  'a' => 'Adm.Tables.El_menu',
);
/**
 * テーブルクラスの関連配列
 * 
 * @access protected
 * @var array
 */
var $table_relations = array();
/**
 * メインメンテナンステーブル名
 * 
 * @access protected
 * @var string
 */
var $maintenance_table = 'a';
/**
 * 関連リンクURL
 * 
 * @access protected
 * @var array
 */
var $related_links = array();
/**
 * 構成定義設定配列
 * 
 * @access protected
 * @var array
 */
var $structs_config = array(
  'title'               => 'el_menu管理',
  'summary'             => '',
  'default_sort'        => array (
  0 => 'a.MENU_ID.ASC',
),
  'default_search_view' => false,
  'page_records'        => 20,
  'link_range'          => 9,
  'key_name'            => 'id',
  'view_confirm'        => true,
  'view_fin'            => true,
  'view_alert'          => false,
  'enable_lst'          => true,
  'enable_new'          => true,
  'enable_upd'          => true,
  'enable_del'          => true,
  'enable_vew'          => true,
  'enable_sch'          => true
);
/**
 * フォーム定義要素配列
 * 
 * @access protected
 * @var array
 */
var $elements_config = array (
  'MENU_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'MENU_ID',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 1,
    'sort_detail' => 1,
  ),
  'APPLICATION_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'APPLICATION_ID',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 2,
    'sort_detail' => 2,
  ),
  'MENU_URL_NAME' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'MENU_URL_NAME',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 3,
    'sort_detail' => 3,
  ),
  'MENU_NAME' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'MENU_NAME',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 4,
    'sort_detail' => 4,
  ),
  'MENU_ORDER' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'MENU_ORDER',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 5,
    'sort_detail' => 5,
  ),
  'PARENT_MENU_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'PARENT_MENU_ID',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 6,
    'sort_detail' => 6,
  ),
  'DEFAULT_TITLE' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'DEFAULT_TITLE',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 7,
    'sort_detail' => 7,
  ),
  'DEFAULT_KEYWORDS' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'DEFAULT_KEYWORDS',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 8,
    'sort_detail' => 8,
  ),
  'DEFAULT_DESCRIPTION' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'DEFAULT_DESCRIPTION',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 9,
    'sort_detail' => 9,
  ),
  'REDIRECT_FLAG' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'REDIRECT_FLAG',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 10,
    'sort_detail' => 10,
  ),
  'REDIRECT_URL' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'REDIRECT_URL',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 11,
    'sort_detail' => 11,
  ),
  'DISPLAY_FLAG' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'DISPLAY_FLAG',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 12,
    'sort_detail' => 12,
  ),
  'ENABLE_FLAG' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'ENABLE_FLAG',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 13,
    'sort_detail' => 13,
  ),
  'CREATE_DATE' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'CREATE_DATE',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 14,
    'sort_detail' => 14,
  ),
  'UPDATE_DATE' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'UPDATE_DATE',
    'attributes' => 
    array (
      'size' => '30',
    ),
    'validate' => 
    array (
    ),
    'sort_list' => 15,
    'sort_detail' => 15,
  ),
);

}
