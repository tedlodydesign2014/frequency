<?php 
/**
* @package   yoo_frequency
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

	$widget_id = $widget->id.'-'.uniqid();
	$settings  = $widget->settings;
	$sets      = array();
	$nav       = array();

	if (is_numeric($settings['items_per_set'])) {
		
		$sets = array_chunk($widget->items, $settings['items_per_set']);

	} else {
	
		foreach ($widget->items as $key => $item) {
			
			if (!isset($sets[$item['set']])) {
				$sets[$item['set']] = array();
			}

			$sets[$item['set']][] = $item;
		}

	}

	foreach (array_keys($sets) as $s) {
		$nav[] = ($settings['navigation'] == 2) ? '<li><span>'.$s.'</span></li>' : '<li><span></span></li>';
	}

	$i = 0;
?>

<div id="slideset-<?php echo $widget_id;?>" class="wk-slideset wk-slideset-frequency" data-widgetkit="slideset" data-options='<?php echo json_encode($settings); ?>'>
	<div>
		<div class="sets">
			<?php foreach ($sets as $set => $items) : ?>
				<ul class="set">
					<?php foreach ($items as $item) : ?>
					<li>
						<article class="wk-content"><?php echo $item['content']; ?></article>
						<?php if($settings['title']): ?>
						<strong class="title"><?php echo $item['title']; ?></strong>
						<?php endif; ?>
						<?php if($item['subcontent']): ?>
						<div class="sub-content"><?php echo $item['subcontent']; ?></div>
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php $i=$i+1;?>
			<?php endforeach; ?>
		</div>
		<?php if ($settings['buttons']): ?><div class="next"></div><div class="prev"></div><?php endif; ?>
	</div>
	<?php if ($settings['navigation'] && count($nav)) : ?>
	<ul class="nav <?php echo ($settings['navigation'] == 1) ? 'icon' : 'text'; ?>"><?php echo implode('', $nav); ?></ul>
	<?php endif; ?>
</div>