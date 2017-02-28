<?php
/**
 * EuryLTableEl_authorityテーブルクラス
 *
 * @access    public
 * @package   EuryL
 * @author    {author}
 * @version   $Id:$
 */
class EuryLTableEl_authority extends SyL_DBDaoTable
{
/**
 * テーブル名
 * 
 * @access protected
 * @var string
 */
var $table = 'el_authority';
/**
 * プライマリキーカラム
 * 
 * @access protected
 * @var array
 */
var $primary = array (
  0 => 'AUTHORITY_ID',
);
/**
 * 一意キーカラム
 * 
 * @access protected
 * @var array
 */
var $uniques = array (
);
/**
 * 外部キーカラム
 * 
 * @access protected
 * @var array
 */
var $foreigns = array (
);
/**
 * カラム定義
 * 
 * @access protected
 * @var array
 */
var $columns = array (
  'AUTHORITY_ID' => 
  array (
    'type' => 'I',
    'validate' => 
    array (
      'require' => 
      array (
        'message' => '{name}は必須です',
      ),
      'numeric' => 
      array (
        'message' => '{name}は数値で入力してください',
        'parameters' => 
        array (
          'dot' => false,
          'min' => '-32768',
          'max' => '32767',
          'min_error_message' => '{name}は{min}以上で入力してください',
          'max_error_message' => '{name}は{max}以下で入力してください',
        ),
      ),
    ),
  ),
  'AUTHORITY_NAME' => 
  array (
    'type' => 'S',
    'validate' => 
    array (
      'require' => 
      array (
        'message' => '{name}は必須です',
      ),
      'length' => 
      array (
        'message' => '{name}は{max}文字（バイト）以内で入力してください',
        'parameters' => 
        array (
          'max' => '100',
        ),
      ),
    ),
  ),
);

}

?>
