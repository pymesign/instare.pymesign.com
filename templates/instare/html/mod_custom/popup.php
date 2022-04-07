<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

//incluimos el modal
\Joomla\CMS\HTML\HTMLHelper::_('bootstrap.modal', '.modal', []);

//incluimos el carousel
\Joomla\CMS\HTML\HTMLHelper::_('bootstrap.carousel', '.carousel', []);



$modId = 'mod-custom' . $module->id;

if ($params->get('backgroundimage')) {
	/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
	$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
	$wa->addInlineStyle('
#' . $modId . '{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}
', ['name' => $modId]);
}

?>

<?php
function ip_visitor_country()
{

	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];
	$country  = "Unknown";

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=" . $ip);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$ip_data_in = curl_exec($ch); // string
	curl_close($ch);

	$ip_data = json_decode($ip_data_in, true);
	$ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

	if ($ip_data && $ip_data['geoplugin_countryCode'] != null) {
		$country = $ip_data['geoplugin_countryCode'];
		//$country = 'CL'; para testear paises por codigo
	}

	return $country;
}

$pais = ip_visitor_country(); // output Coutry name

echo $pais;



?>

<div id="<?php echo $modId; ?>" class="mod-custom custom">
	<?php echo $module->content; ?>

	<button id="popupcountry" style="display: none;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Launch modal</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-body">
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner">
						<?php
						$directory = "images/$pais/";
						//echo $directory;
						if (!is_dir($directory)) {
							$directory = "images/AR/";
						}

						$files = glob($directory . "*");

						$len = count($files);

						//print_r($files);
						/*foreach ($files as $file) {
							echo '<div class="carousel-item">';
							echo '<img src="' . $file . '" class="d-block w-100" alt="...">';
							echo '</div>';
						}*/
						foreach ($files as $index => $item) {
							if ($index == 0) {
								// first
								echo '<div class="carousel-item active">';
								echo '<img src="' . $item . '" class="d-block w-100" alt="...">';
								echo '</div>';
								continue;
							} else {
								// last
								echo '<div class="carousel-item">';
								echo '<img src="' . $item . '" class="d-block w-100" alt="...">';
								echo '</div>';
								continue;
							}
						}
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>





</div>