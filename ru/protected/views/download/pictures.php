
</div>
		<div id="page">
			<div id="container">
				<!-- Start Advanced Gallery Html Containers -->
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
				</div>
				<div id="pager">
				    <?php

				    $this->widget('CLinkPager',array(
				        'header'=>'',
				        'firstPageLabel' => Yii::t('common','pagefirst'),
				        'lastPageLabel' => Yii::t('common','pagelast'),
				        'prevPageLabel' => Yii::t('common','pagepre'),
				        'nextPageLabel' => Yii::t('common','pagenext'),
				        'pages' => $pages,
				        'maxButtonCount'=>6
				        )
				    );
				    ?>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
						<?php
						//$dataRes = $dataProvider->getData();
						foreach($dataProvider as $data) {
							echo '<li>';
							echo CHtml::link(
								CHtml::image(
									Helper::shortImg2Preview($data->path, 'download', 90, 90),
									CHtml::encode($data->title)
								),
								Helper::shortImg2Preview($data->path, 'download',500,500),
								array('class' => 'thumb', 'title' => CHtml::encode($data->title))
							);
							echo '<div class="caption"><div class="download">';
							echo CHtml::link(Yii::t('download','bigpic'), Helper::shortImg2ImgUrl($data->path, 'download'), array('target'=>'_blank'));
							echo '&nbsp;&nbsp;';
							echo CHtml::link(Yii::t('download','downloadimage'), str_replace(Helper::getAttachmentPath(),'',Helper::shortImg2ImgUrl($data->path, 'download')), array('target'=>'_blank'));
							echo '</div>';
							echo '<div class="image-title">'.CHtml::encode($data->title).'</div>';
							echo '<div class="image-desc">'.CHtml::encode($data->desp).'</div>';
							echo '</div>';
							echo '</li>';
						}
						?>
					</ul>
				</div>
				<div style="clear: both;"></div>
				<div id="pager">
				    <?php

				    $this->widget('CLinkPager',array(
				        'header'=>'',
				        'firstPageLabel' => Yii::t('common','pagefirst'),
				        'lastPageLabel' => Yii::t('common','pagelast'),
				        'prevPageLabel' => Yii::t('common','pagepre'),
				        'nextPageLabel' => Yii::t('common','pagenext'),
				        'pages' => $pages,
				        'maxButtonCount'=>6
				        )
				    );
				    ?>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				// We only want these styles applied when javascript is enabled
				$('div.navigation').css({'width' : '350px', 'float' : 'left'});
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});

				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 15,
					preloadAhead:              10,
					enableTopPager:            true,
					enableBottomPager:         true,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
			});
		</script>