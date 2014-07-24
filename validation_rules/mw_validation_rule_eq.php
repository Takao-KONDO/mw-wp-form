<?php
/**
 * Name: MW Validation Rule Eq
 * Description: 値が一致している
 * Version: 1.0.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : July 21, 2014
 * Modified:
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_Validation_Rule_Eq extends MW_Validation_Rule {

	/**
	 * バリデーションルール名を指定
	 */
	protected $name = 'eq';

	/**
	 * rule
	 * @param MW_WP_Form_Data $Data
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( MW_WP_Form_Data $Data, $key, $options = array() ) {
		$value = $Data->get( $key );
		if ( !is_null( $value ) ) {
			$defaults = array(
				'target' => null,
				'message' => __( 'This is not in agreement.', MWF_Config::DOMAIN )
			);
			$options = array_merge( $defaults, $options );
			$target_value = $Data->get( $options['target'] );
			if ( $value !== $target_value ) {
				return $options['message'];
			}
		}
	}

	/**
	 * admin
	 * @param numeric $key バリデーションルールセットの識別番号
	 * @param array $value バリデーションルールセットの内容
	 */
	public function admin( $key, $value ) {
		?>
		<table>
			<tr>
				<td><?php esc_html_e( 'The key at same value', MWF_Config::DOMAIN ); ?></td>
				<td><input type="text" value="<?php echo esc_attr( @$value[$this->name]['target'] ); ?>" name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->name ); ?>][target]" /></td>
			</tr>
		</table>
		<?php
	}
}