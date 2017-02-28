<?php
/**
 * AdmFormsEl_userフォームクラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class AdmFormsEl_user extends SyL_AdmActionForm
{
/**
 * テーブルクラスの配列
 * 
 * @access protected
 * @var array
 */
var $table_classes = array (
  'a' => 'Adm.Tables.El_user',
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
  'title'               => 'el_user管理',
  'summary'             => 'コレはテストヘッドラインです2。',
  'default_sort'        => array (
  0 => 'a.USER_ID.ASC',
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
  'USER_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'USER_ID',
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
  'USER_NAME' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'USER_NAME',
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
  'LOGIN_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'LOGIN_ID',
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
  'LOGIN_PASSWD' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'LOGIN_PASSWD',
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
  'EMAIL' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'EMAIL',
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
    'sort_list' => 6,
    'sort_detail' => 6,
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
    'sort_list' => 7,
    'sort_detail' => 7,
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
    'sort_list' => 8,
    'sort_detail' => 8,
  ),
);

}
