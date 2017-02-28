<?php
/**
 * AdmFormsEl_user_historyフォームクラス
 *
 * @access    public
 * @package   AquaGarden
 * @author    {author}
 * @version   $Id:$
 */
class AdmFormsEl_user_history extends SyL_AdmActionForm
{
/**
 * テーブルクラスの配列
 * 
 * @access protected
 * @var array
 */
var $table_classes = array (
  'a' => 'Adm.Tables.El_user_history',
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
  'title'               => 'el_user_history管理',
  'summary'             => '',
  'default_sort'        => array (
  0 => 'a.USER_HISTORY_ID.ASC',
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
  'USER_HISTORY_ID' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'USER_HISTORY_ID',
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
    'sort_list' => 2,
    'sort_detail' => 2,
  ),
  'ACTION_NAME' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'ACTION_NAME',
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
  'IP_ADDRESS' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'IP_ADDRESS',
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
  'DOMAIN' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'DOMAIN',
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
  'USER_AGENT' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'USER_AGENT',
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
  'REFERRER_URI' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'REFERRER_URI',
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
  'ACTION_DATE' => 
  array (
    'alias' => 'a',
    'type' => 'text',
    'name' => 'ACTION_DATE',
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
