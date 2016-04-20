<?php

/**
 * Plugin Name: Stay Working - Return to Work Form
 * Plugin URI: http://stayworkingsystem.com/
 * Description: Custom plugin for Stay Working
 * Author: Thinking Cap Communications & Design
 * Author URI: http://tcapdesign.com/
 * Version: 1.0.0
 * Text Domain: return-to-work
 *
 * Copyright 2016 Thinking Cap Communications & Design
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 */

namespace StayWorking;

class ReturnToWork {

	const VERSION = '1.0.0';
	const VERSION_JS = '1.0.0';
	const VERSION_CSS = '1.0.0';
	const OPTION_VERSION = 'return_to_work_form_version';

	public $states = array();
	
	public function activate()
	{
		add_option( self::OPTION_VERSION, self::VERSION );
	}
	
	public function init()
	{
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
		wp_enqueue_script( 'return-to-work-form-js', plugin_dir_url( __FILE__ ) . 'return-to-work-form.js', array( 'jquery' ), ( WP_DEBUG ) ? time() : self::VERSION_JS );
		wp_enqueue_style( 'return-to-work-form-bootstrap-css', plugin_dir_url( __FILE__ ) . 'bootstrap.css', array(), ( WP_DEBUG ) ? time() : self::VERSION_CSS );
		wp_enqueue_style( 'return-to-work-form-css', plugin_dir_url( __FILE__ ) . 'return-to-work-form.css', array(), ( WP_DEBUG ) ? time() : self::VERSION_CSS );

		$this->states = array(
			'AK' => 'Alaska',
			'AL' => 'Alabama',
			'AR' => 'Arkansas',
			'AZ' => 'Arizona',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DC' => 'Washington DC',
			'DE' => 'Delaware',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'IA' => 'Iowa',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'MA' => 'Massachusetts',
			'MD' => 'Maryland',
			'ME' => 'Maine',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MO' => 'Missouri',
			'MS' => 'Mississippi',
			'MT' => 'Montana',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'NE' => 'Nebraska',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NV' => 'Nevada',
			'NY' => 'New York',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VA' => 'Virginia',
			'VT' => 'Vermont',
			'WA' => 'Washington',
			'WI' => 'Wisconsin',
			'WV' => 'West Virginia',
			'WY' => 'Wyoming'
		);
	}
	
	public function shortcode()
	{
		ob_start();
		include ( 'form.php' );
		return ob_get_clean();
	}

	public function add_settings_link( $links )
	{
		$settings_link = '<a href="options-general.php?page=' . plugin_basename( __FILE__ ) . '">' . __( 'Instructions' ) . '</a>';
		$links[] = $settings_link;
		return $links;
	}

	public function add_settings_page()
	{
		add_options_page(
			'Stay Working System',
			'Stay Working System',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'options_page')
		);
	}

	public function options_page()
	{
		echo "
			<div class='wrap'>
        		<h2>Stay Working System - Return to Work Form Instructions</h2>
        		<p>
        			To add the return to work form to any WordPress page, 
        			simply copy and paste the below shortcode into the content section of your page:
                </p>

    			[return_to_work_form]

    		</div>";
	}

	public function form_capture()
	{
		if ( isset( $_POST['return_to_work_form'] ) && $_POST['return_to_work_form'] == 'submit' )
		{
			echo "
				<html>
				<head>
				<title>Return to Work Letter</title>
				<meta charset=\"UTF-8\"> 
				<style>
					html, body {
						font-family: 'Open Sans', Helvetica, Arial, sans-serif;
						font-size: 13px;
					}
					.letter {
						page-break-after: always;
						margin-left: auto;
						margin-right: auto;
						max-width: 800px;
					}
					.note {
						 color: red; 
						 border: 3px solid red; 
						 padding: 5px; 
						 text-align: center;
						 font-weight: bold;
					}
					@media print {
						.letter {
							max-width: 100%;
						}
						.note {
							display: none;
						}
					}
				</style>
				</head>
				<body>";

			$languages = $_POST['language'];
			foreach ( $languages as $language )
			{
				$letter = '
					<div class="letter">
					<p class="note">Note: A legal offer requires personal or certified mail delivery.</p>
					<p>' .  date( 'F j, Y' ) . '</p>
					<p>
						' . $_POST['first_name'] . ' ' . $_POST['last_name'] . '<br />
						' . $_POST['address1'] . '<br />
						' . ( ( strlen( $_POST['address2'] ) > 0 ) ? $_POST['address2'] . '<br />' : '' ) . '
						' . $_POST['city'] . ', ' . $_POST['state'] . ' ' . $_POST['zip'] . '
					</p>';

				if ( $language == 'English' )
				{
					$letter .= "
						<p>
							Re: Return to Work Job Offer<br />
							L &amp; I Claim No. [[claimNo]]
						</p>
						<p>Dear [[firstName]],</p>
						<p>
							I am pleased to offer you [[tld]] [[permanent]] employment that will accommodate your current physical capacities. 
							Your duties are described in the attached Job Description, and are consistent with all physical limitations established by your doctor. 
							Your doctor approved these duties on [[drApprovalDate]]. 
							A copy has been sent to your claim manager.
						</p>
						<p>
							You should report to work on [[workDate]] at [[locationAddress]], [[locationCity]], [[locationState]], [[locationZip]]. 
							Your supervisor will be [[supervisorName]]. 
							He/She has been advised of the physical limitations established by your doctor and these job duties are based on the restrictions imposed by your doctor. 
							Work hours are from [[startTime]] to [[endTime]], on [[daysOfTheWeek]], for [[hoursPerWeek]] hours per week. 
							Your wages will be $[[wage]] per [[wageDuration]]. 
							If this is less than 95% of your regular wages, you may qualify for Loss of Earning Power benefits, ask your supervisor. 
							It is important you schedule any medical and therapy appointments around your work schedule as you won&rsquo;t be compensated for time absent from work. 
							You are also expected to comply with all company work rules and attendance policies as with all our employees.
						</p>
						<p>
							If you experience any difficulties in the performance of your duties, you are to report them to your supervisor immediately. 
							Our goal is to provide all employees with a safe and injury free environment. 
							This requires that you work within all physical limitations approved by your doctor. 
							If any employee requests that you perform a task beyond your physical capacities, you should remind that employee of your physical restrictions. 
							If you are still requested to perform a task beyond your limitations, you are instructed not to perform that task and report immediately to your supervisor and advise him/her of the situation. 
							Consistent with our company safety policy, you may be subject to disciplinary action for working beyond your physical limitations established by your doctor. 
							I wish to welcome you back. 
							Should you decide not to accept this offer of employment, please call me at [[contactPhone]]. 
							If you do not call me or report to work, that will be considered as your decision to reject this offer of employment, and your time loss benefits may be affected. 
							Please remember to bring this letter with you or return by mail with your signature.
						</p>
						<p>Sincerely,</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>Enclosed: Job Description approved by attending physician</p>
						<p>[[ccLine1]][[ccLine2]][[ccLine3]]</p>
						<p>[ &nbsp;] I reject the above offered position. OR</p>
						<p>[ &nbsp;] I accept the above offered position and am reporting to work.</p>
						<p>
							<br />
							____________________________  ________________________
							<br />
							Worker Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date
						</p>";
				}
				elseif ( $language == 'Russian' )
				{
					$letter .= "
						<p>
							По вопросу: Предложение вернуться на работу<br />
							L &amp; I Номер иска [[claimNo]]
						</p>
						<p>Уважаемый (-ая) [[firstName]],</p>
						<p>
							С радостью предлагаю Вам [[tld]] [[permanent]] трудоустройство, которое соответствует Вашим сложившимся физическим способностям. 
							Ваши должностные обязанности описаны в прилагаемой должностной инструкции и отвечают всем требованиям по ограничениям физического характера, установленным Вашим врачом. 
							Ваш врач утвердил данный список служебных обязанностей [[drApprovalDate]]. 
							Копия документа также была предоставлена Вашему менеджеру по искам.
						</p>
						<p>
							Вам необходимо явиться на работу [[workDate]] по адресу [[locationAddress]], [[locationCity]], [[locationState]], [[locationZip]]. 
							Вашим руководителем будет [[supervisorName]]. Он/она был (-а) проинформирован (-а) об ограничениях физического характера, установленных Вашим врачом, данные служебные обязанности основываются на ограничениях, предписанных Вашим врачом. 
							Рабочие часы с [[startTime]] до [[endTime]], на [[daysOfTheWeek]], всего [[hoursPerWeek]] часов в неделю. 
							Ваша заработная плата составит $[[wage]] в [[wageDuration]]. Если это составляет менее 95% от Вашей постоянной заработной платы, Вы можете претендовать на пособие при потере заработка, с вопросами об этом обратитесь к своему руководителю. 
							Вам необходимо планировать любые медицинские и лечебные приемы в нерабочее время, так как пропущенное рабочее время Вам не будет оплачено. 
							Вы также должны следовать всем правилам внутреннего распорядка в компании, а также правилам посещаемости наравне со всеми нашими сотрудниками.
						</p>
						<p>
							Если у Вас возникнут какие-либо трудности при исполнении ваших служебных обязанностей, Вы должны немедленно сообщить об этом своему руководителю. 
							Мы стремимся предоставить благополучные и травмобезопасные условия труда для всех сотрудников. 
							При этом подразумевается, что Вы будете работать в рамках физических ограничений, установленных Вашим врачом. 
							Если какой-либо сотрудник просит Вас выполнить задание, которое превышает Ваши физические возможности, Вы должны отказаться от выполнения подобного задания и немедленно сообщить о данной ситуации Вашему руководителю. 
							Согласно правилам техники безопасности в нашей компании, Вы можете понести дисциплинарную ответственность за выполнение работ, превышающих рамки Ваших физических ограничений, установленных Вашим врачом. 
							Мы будем рады вновь увидеть Вас с нами. В случае, если Вы решите отказаться от данного предложения о трудоустройстве, перезвоните мне по телефону [[contactPhone]]. 
							Если Вы не позвоните и не явитесь на работу, это будет рассматриваться, как Ваш отказ от данного предложения о трудоустройстве, и это может отразиться на Ваших выплатах за потерянное время. 
							Не забудьте принести с собой данное письмо или послать его по почте с Вашей подписью.
						</p>
						<p>С уважением,</p>
						<p>&nbsp;</p>
						<p>
							<br />
							________________________________________________________<br />
							Подпись руководителя, отдела кадров или владельца компании
						</p>
						<p>В приложении: должностная инструкция, утвержденная штатным врачом</p>
						<p>
							[[ccLine1]][[ccLine2]][[ccLine3]]<br />
							&nbsp;
						</p>
						<p>[ &nbsp;]&nbsp;Я отказываюсь принять предложенную выше должность.&nbsp;или</p>
						<p>[ &nbsp;] Я принимаю предложенную выше должность и приступаю к работе.</p>
						<p>
							<br />
							____________________________           ________________________
							<br />
							Подпись сотрудника&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                      Дата
						</p>";
				}
				elseif ( $language == 'Spanish' )
				{
					$letter .= "
						<p>
							Re: Oferta de regreso al trabajo.<br />
							L &amp; I Reclamaci&oacute;n N &ordm; [[claimNo]]
						</p>
						<p>Estimado ([[firstName]],)</p>
						<p>
							Tengo el agrado de ofrecerle [[tld]] [[permanent]] empleo que se adaptan a sus capacidades f&iacute;sicas actuales. 
							Sus funciones se describen en el documento adjunto, Descripci&oacute;n del Trabajo, y sean compatibles con todas las limitaciones f&iacute;sicas establecidas por su m&eacute;dico. 
							Su m&eacute;dico ha aprobado estas funciones en [[drApprovalDate]]. 
							Una copia ha sido enviada a su gerente de reclamo.
						</p>
						<p>
							Usted debe presentarse a trabajar el d&iacute;a [[workDate]] en [[locationAddress]], [[locationCity]], [[locationState]]., [[locationZip]]. 
							Su supervisor ser&aacute; [[supervisorName]]. &Eacute;l / Ella ha sido avisado de las limitaciones f&iacute;sicas establecidas por su m&eacute;dico y estas funciones de trabajo se basan en las restricciones impuestas por su m&eacute;dico. 
							Las horas de trabajo son de [[startTime]] a [[endTime]], en&nbsp;[[daysOfTheWeek]], por [[hoursPerWeek]] horas por semana. 
							Su salario ser&aacute; $[[wage]] por [[wageDuration]]. 
							Si es menos de 95% de su sueldo regular, usted puede calificar para la p&eacute;rdida de ganancia de beneficios de alimentaci&oacute;n, consulte a su supervisor. 
							Es importante programar las citas m&eacute;dicas y terapia alrededor de su horario de trabajo, ya que no ser&aacute; compensado por el tiempo ausente de su trabajo. 
							Tambi&eacute;n se espera que cumpla con todas las normas de trabajo de la empresa y las pol&iacute;ticas de asistencia como con todos nuestros empleados.
						</p>
						<p>
							Si tiene alguna dificultad en el desempe&ntilde;o de sus funciones, usted debe informar a su supervisor de inmediato. 
							Nuestro objetivo es proporcionar a todos los empleados un ambiente seguro y libre de lesiones. 
							Esto requiere que se trabaja dentro de todas las limitaciones f&iacute;sicas aprobados por su m&eacute;dico. 
							Si alg&uacute;n empleado solicita que realice una tarea m&aacute;s all&aacute; de sus capacidades f&iacute;sicas, debe recordarles a los empleados de sus limitaciones f&iacute;sicas. 
							Si a&uacute;n, as&iacute; se le solicita que realice una tarea m&aacute;s all&aacute; de sus limitaciones, se le indica no llevar a cabo esa tarea e informar inmediatamente a su supervisor y &eacute;l / ella le aconsejara de la situaci&oacute;n. 
							De acuerdo con nuestra pol&iacute;tica de seguridad de la compa&ntilde;&iacute;a, usted puede estar sujeto a una acci&oacute;n disciplinaria para trabajar m&aacute;s all&aacute; de sus limitaciones f&iacute;sicas establecidas por su m&eacute;dico.
							Deseo dar la bienvenida de nuevo. Si usted decide no aceptar esta oferta de empleo, por favor de llamarme [[contactPhone]]. 
							Si no me llamas o no te presentas a trabajar, se considerar&aacute; como su decisi&oacute;n de rechazar esta oferta de empleo, y los beneficios de la p&eacute;rdida de tiempo puede ser afectada. 
							Por favor recuerde traer esta carta con usted, o envi&eacute; por correo con su firma.
						</p>
						<p>
							Atentamente,<br />
							(Supervisor o H.R. propietario o firma)
						</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>Adjunto: Descripci&oacute;n del trabajo aprobado por el m&eacute;dico</p>
						<p>[[ccLine1]][[ccLine2]][[ccLine3]]</p>
						<p>[ &nbsp;] Yo rechazo la posici&oacute;n ofrecida. O</p>
						<p>[ &nbsp;] Acepto el puesto ofrecido arriba y me reportare al trabajo.</p>
						<p>&nbsp;</p>
						<p>
							____________________________       ________________________
							<br />
							Trabajador Firma &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;                                         Fecha
						</p>";
				}

				$letter = str_replace( '[[claimNo]]', $_POST['claim_number'], $letter );
				$letter = str_replace( '[[firstName]]', $_POST['first_name'], $letter );

				$job_lengths = $_POST['job_length'];
				$job_lengths = implode( ', ', $job_lengths );
				if ( $language == 'Spanish' )
				{
					//$job_lengths = str_replace( 'transitional/light duty', '', $job_lengths );
					//$job_lengths = str_replace( 'permanent', '', $job_lengths );
				}
				elseif ( $language == 'Russian' )
				{
					//$job_lengths = str_replace( 'transitional/light duty', '', $job_lengths );
					//$job_lengths = str_replace( 'permanent', '', $job_lengths );
				}

				$letter = str_replace( '[[tld]]', '', $letter );
				$letter = str_replace( '[[permanent]]', $job_lengths, $letter );

				$letter = str_replace( '[[drApprovalDate]]', $_POST['doctor_approval'], $letter );
				$letter = str_replace( '[[workDate]]', $_POST['report_to_work'], $letter );
				$letter = str_replace( '[[locationAddress]]', $_POST['location_address'], $letter );
				$letter = str_replace( '[[locationCity]]', $_POST['location_city'], $letter );
				$letter = str_replace( '[[locationState]]', $_POST['location_state'], $letter );
				$letter = str_replace( '[[locationZip]]', $_POST['location_zip'], $letter );
				$letter = str_replace( '[[supervisorName]]', $_POST['supervisor_name'], $letter );
				$letter = str_replace( '[[startTime]]', $_POST['start_time'], $letter );
				$letter = str_replace( '[[endTime]]', $_POST['end_time'], $letter );

				$days = array();
				foreach ( $_POST['day_of_week'] AS $day_of_week )
				{
					$days[] = $day_of_week;
				}

				if ( count( $days ) == 1 )
				{
					$days_of_week = $days[0];
				}
				else
				{
					$last_day_of_week = $days[ count( $days ) - 1 ];
					unset( $days[ count( $days ) - 1 ] );
					$days_of_week = implode( ', ', $days );

					if ( $language == 'English' )
					{
						$days_of_week .= ' and';
						$days_of_week .= ' ' . $last_day_of_week;
					}
					elseif ( $language == 'Spanish' )
					{
						$days_of_week .= ' y';
						$days_of_week .= ' ' . $last_day_of_week;
						$days_of_week = str_replace( 'Monday', 'Lunes', $days_of_week );
						$days_of_week = str_replace( 'Tuesday', 'Martes', $days_of_week );
						$days_of_week = str_replace( 'Wednesday', 'Miércoles', $days_of_week );
						$days_of_week = str_replace( 'Thursday', 'Jueves', $days_of_week );
						$days_of_week = str_replace( 'Friday', 'Viernes', $days_of_week );
						$days_of_week = str_replace( 'Saturday', 'Sábado', $days_of_week );
						$days_of_week = str_replace( 'Sunday', 'Domingo', $days_of_week );
					}
					elseif ( $language == 'Russian' )
					{
						$days_of_week .= ' и';
						$days_of_week .= ' ' . $last_day_of_week;
						$days_of_week = str_replace( 'Monday', 'понедельник', $days_of_week );
						$days_of_week = str_replace( 'Tuesday', 'вторник', $days_of_week );
						$days_of_week = str_replace( 'Wednesday', 'среда', $days_of_week );
						$days_of_week = str_replace( 'Thursday', 'четверг', $days_of_week );
						$days_of_week = str_replace( 'Friday', 'пятница', $days_of_week );
						$days_of_week = str_replace( 'Saturday', 'суббота', $days_of_week );
						$days_of_week = str_replace( 'Sunday', 'воскресенье', $days_of_week );
					}
				}
				$letter = str_replace( '[[daysOfTheWeek]]', $days_of_week, $letter );

				$letter = str_replace( '[[hoursPerWeek]]', $_POST['hours_per_week'], $letter );

				$dollar_amount = $_POST['dollar_amount'];
				$dollar_amount = '0' . preg_replace( '/[^0-9\.]/', '', $dollar_amount );
				$dollar_amount = number_format( $dollar_amount, 2 );

				$letter = str_replace( '[[wage]]', $dollar_amount, $letter );

				$wage_duration = $_POST['per'];
				if ( $language == 'Spanish' )
				{
					switch ( $wage_duration )
					{
						case 'hour':
							$wage_duration = 'hora';
							break;
						case 'day':
							$wage_duration = 'día';
							break;
						case 'week':
							$wage_duration = 'semana';
							break;
					}
				}
				elseif ( $language == 'Russian' )
				{
					switch ( $wage_duration )
					{
						case 'hour':
							$wage_duration = 'час';
							break;
						case 'day':
							$wage_duration = 'день';
							break;
						case 'week':
							$wage_duration = 'неделя';
							break;
					}
				}
				$letter = str_replace( '[[wageDuration]]', $wage_duration, $letter );
				$letter = str_replace( '[[contactPhone]]', $_POST['contact_phone'], $letter );
				if ( strlen( $_POST['cc1'] ) > 0 )
				{
					$letter = str_replace( '[[ccLine1]]', 'CC: ' . $_POST['cc1'] . '<br>', $letter );
				}
				else
				{
					$letter = str_replace( '[[ccLine1]]', '', $letter );
				}
				if ( strlen( $_POST['cc2'] ) > 0 )
				{
					$letter = str_replace( '[[ccLine2]]', 'CC: ' .$_POST['cc2'] . '<br>', $letter );
				}
				else
				{
					$letter = str_replace( '[[ccLine2]]', '', $letter );
				}
				if ( strlen( $_POST['cc3'] ) > 0 )
				{
					$letter = str_replace( '[[ccLine3]]', 'CC: ' .$_POST['cc3'] . '<br>', $letter );
				}
				else
				{
					$letter = str_replace( '[[ccLine3]]', '', $letter );
				}

				$letter .= "</div>";
				echo $letter;
			}

			echo "
				</body>
				</html>";

			exit;
		}
	}
}

$controller = new ReturnToWork;

/** activate */
register_activation_hook( __FILE__, array( $controller, 'activate' ) );

/** Initialize any variables that the plugin needs */
add_action( 'init', array( $controller, 'init' ) );

/** Register shortcode */
add_shortcode ( 'return_to_work_form', array( $controller, 'shortcode') );

/* capture form post */
add_action ( 'init', array( $controller, 'form_capture' ) );

if ( is_admin() )
{
	/* add the instructions page link */
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $controller, 'add_settings_link' ) );

	/* add the instructions page */
	add_action( 'admin_menu', array( $controller, 'add_settings_page' ) );
}
