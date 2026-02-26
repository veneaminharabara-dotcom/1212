<?php
/* Template: Обзор брокера (review-broker.html) — slug: review-broker */
get_header();
?>
<main class="page">
	<section class="top-broker">
		<div class="top-broker__container">
			<div class="top-broker__body">
				<div class="top-broker__content">
					<div class="top-broker__image">
						<picture><source srcset="<?php broker_asset( 'img/icons/global.webp' ); ?>" type="image/webp"><img src="<?php broker_asset( 'img/icons/global.jpg' ); ?>" alt="Иконка"></picture>
					</div>
					<div class="top-broker__info">
						<div class="top-broker__status">
							<div class="top-broker__icon"><img src="<?php broker_asset( 'img/icons/check2.svg' ); ?>" alt="Иконка"></div>
							<p class="top-broker__info-status">Статус: Надежный</p>
						</div>
						<h1 class="top-broker__name">Logotip Company</h1>
						<div class="top-broker__rating">
							<div class="top-broker__rating-block">
								<span class="top-broker__number">4.5</span>
								<ul class="top-broker__rating-list">
									<li class="top-broker__rating-item"><img src="<?php broker_asset( 'img/icons/star-white.svg' ); ?>" alt="иконка"></li>
									<li class="top-broker__rating-item"><img src="<?php broker_asset( 'img/icons/star-white.svg' ); ?>" alt="иконка"></li>
									<li class="top-broker__rating-item"><img src="<?php broker_asset( 'img/icons/star-white.svg' ); ?>" alt="иконка"></li>
									<li class="top-broker__rating-item"><img src="<?php broker_asset( 'img/icons/star-white.svg' ); ?>" alt="иконка"></li>
									<li class="top-broker__rating-item top-broker__rating-item--half"><img src="<?php broker_asset( 'img/icons/star-white.svg' ); ?>" alt="иконка"></li>
								</ul>
							</div>
							<a href="#" class="top-broker__reviews-link">Отзывов: 20,341</a>
						</div>
						<ul data-da=".top-broker__body,767.98" class="top-broker__links">
							<li class="top-broker__links-item"><a href="#" class="top-broker__link-bottom btn">Обзор <img src="<?php broker_asset( 'img/icons/eye.svg' ); ?>" alt="иконка"> </a></li>
							<li class="top-broker__links-item"><a href="#" class="top-broker__link-bottom btn">Отзывы <img src="<?php broker_asset( 'img/icons/reviews.svg' ); ?>" alt="иконка"> </a></li>
							<li class="top-broker__links-item"><a href="#" class="top-broker__link-bottom btn">Факты <img src="<?php broker_asset( 'img/icons/facts.svg' ); ?>" alt="иконка"> </a></li>
						</ul>
					</div>
				</div>
				<!-- reviews, block-top-broker и далее как в исходнике -->
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>