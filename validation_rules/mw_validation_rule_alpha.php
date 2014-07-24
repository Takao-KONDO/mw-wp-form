<?php
/**
 * Name: MW Validation Rule Alpha
 * Description: 値がアルファベット
 * Version: 1.0.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : July 21, 2014
 * Modified:
 * License: GPLv2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_Validation_Rule_Alpha extends MW_Validation_Rule {

	/**
	 * バリデーションルール名を指定
	 */
	protected $name = 'alpha';

	/**
	 * rule
	 * @param MW_WP_Form_Data $Data
	 * @param string $key name属性
	 * @param array $option
	 * @return string エラーメッセージ
	 */
	public function rule( MW_WP_Form_Data $Data, $key, $options = array() ) {
		$value = $Data->get( $key );
		if ( !is_null( $value ) && !$this->isEmpty( $value ) ) {
			if ( !preg_match( '/^[A-Za-z]+$/', $value ) ) {
				$defaults = array(
					'message' => __( 'Please enter with a half-width alphabetic character.', MWF_Config::DOMAIN )
				);
				$options = array_merge( $defaults, $options );
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
		<label><input type="checkbox" <?php checked( $value[$this->name], 1 ); ?> name="<?php echo MWF_Config::NAME; ?>[validation][<?php echo $key; ?>][<?php echo esc_attr( $this->name ); ?>]" value="1" /><?php esc_html_e( 'Alphabet', MWF_Config::DOMAIN ); ?></label>
		<?php
	}
}