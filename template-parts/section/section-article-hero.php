<?php
/**
 * Section Homepage Hero
 * 
 * @param array $args Template part arguments
 */

// Access passed variables
$article_thumbnail = $args['article_thumbnail'];
$article_title = $args['article_title'];
$article_created_at = $args['article_created_at'];
?>

<link href="<?php echo get_template_directory_uri(); ?>/dist/section-article-hero.css" rel="stylesheet" type="text/css" media="all">

<section 
    data-section="ArticleHero"
    class="mt-[6.75rem] pb-6 lg:pb-12 lg:mt-[8.5rem]"
>
    <div class="container"> 
        <div 
            class="bg-light-blue px-4 py-6 rounded-3xl overflow-hidden bg-cover bg-center bg-no-repeat lg:p-12"
            style="background-image: url(<?php echo get_template_directory_uri(); ?>/public/figures/patter-horizontal.svg);"
        >
            <div class="lg:grid lg:grid-cols-[1fr_auto] lg:gap-10">
                <div class="grid gap-2 lg:self-center lg:max-w-[37.5rem]">
                    <p class="text-sm font-medium tracking-tight text-blue lg:text-lg">
                        ARTÍCULO
                    </p>
                    <h1 class="text-[2rem] font-medium tracking-tight leading-tight text-blue lg:text-[3.5rem]">
                        <?php echo $article_title; ?>
                    </h1>
                </div>
    
                <div 
                    class="article-hero__image"
                    style="--mask-url: url(<?php echo get_template_directory_uri(); ?>/public/shapes/shape-2.svg);"
                >
                    <img src="<?php echo $article_thumbnail; ?>" alt="<?php echo $article_title; ?>">
                </div>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-blue/20 lg:pt-6">
                <div>
                    <p class="uppercase text-sm tracking-tight text-blue font-semibold lg:text-lg lg:font-medium"><?php echo $article_created_at; ?></p>
                </div>

                <div>
                    <button type="button" class="flex items-center gap-3 text-blue article-hero__share-button" aria-label="Compartir">
                        <span class="hidden text-lg font-medium tracking-tight lg:block">
                            COMPARTIR ARTÍCULO
                        </span>
                        <svg class="article-hero__share-button--share" width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.5025 14.1909C14.0015 14.1907 13.5062 14.2964 13.0489 14.5011C12.5917 14.7058 12.1829 15.0049 11.8494 15.3787L7.26499 12.4321C7.46283 11.9818 7.56499 11.4953 7.56499 11.0034C7.56499 10.5115 7.46283 10.025 7.26499 9.57462L11.8494 6.62806C12.4475 7.2952 13.275 7.71248 14.167 7.79672C15.059 7.88097 15.95 7.626 16.6624 7.08264C17.3748 6.53927 17.8563 5.74741 18.011 4.86487C18.1656 3.98233 17.982 3.07393 17.4968 2.32071C17.0116 1.56749 16.2604 1.02476 15.3928 0.800699C14.5253 0.576636 13.6052 0.68769 12.8159 1.11173C12.0267 1.53577 11.4261 2.24165 11.1341 3.08869C10.842 3.93573 10.8798 4.86173 11.24 5.68212L6.65561 8.62869C6.17465 8.09083 5.54171 7.7117 4.84055 7.54146C4.13939 7.37121 3.40307 7.41789 2.72902 7.67531C2.05497 7.93273 1.47497 8.38875 1.06578 8.98304C0.656592 9.57732 0.4375 10.2818 0.4375 11.0034C0.4375 11.7249 0.656592 12.4294 1.06578 13.0237C1.47497 13.618 2.05497 14.074 2.72902 14.3314C3.40307 14.5889 4.13939 14.6355 4.84055 14.4653C5.54171 14.295 6.17465 13.9159 6.65561 13.3781L11.24 16.3246C10.9322 17.0276 10.8597 17.8111 11.0331 18.5586C11.2066 19.3061 11.6167 19.9776 12.2026 20.4732C12.7885 20.9688 13.5187 21.262 14.2846 21.3091C15.0505 21.3563 15.8112 21.1549 16.4534 20.7348C17.0956 20.3148 17.585 19.6987 17.8488 18.9781C18.1126 18.2575 18.1367 17.471 17.9174 16.7356C17.6982 16.0002 17.2474 15.3553 16.6321 14.8968C16.0168 14.4382 15.2698 14.1907 14.5025 14.1909ZM14.5025 1.81587C14.9846 1.81587 15.4558 1.95883 15.8567 2.22667C16.2575 2.4945 16.57 2.87519 16.7544 3.32058C16.9389 3.76598 16.9872 4.25608 16.8931 4.72891C16.7991 5.20174 16.5669 5.63606 16.2261 5.97695C15.8852 6.31784 15.4508 6.54999 14.978 6.64404C14.5052 6.73809 14.0151 6.68982 13.5697 6.50533C13.1243 6.32084 12.7436 6.00842 12.4758 5.60758C12.2079 5.20673 12.065 4.73547 12.065 4.25337C12.065 3.60691 12.3218 2.98692 12.7789 2.5298C13.236 2.07268 13.856 1.81587 14.5025 1.81587ZM4.00249 13.4409C3.52039 13.4409 3.04913 13.2979 2.64828 13.0301C2.24744 12.7622 1.93502 12.3816 1.75053 11.9362C1.56604 11.4908 1.51777 11.0007 1.61182 10.5278C1.70587 10.055 1.93802 9.62069 2.27891 9.2798C2.6198 8.93891 3.05412 8.70676 3.52695 8.61271C3.99978 8.51866 4.48988 8.56693 4.93528 8.75142C5.38067 8.93591 5.76136 9.24833 6.02919 9.64917C6.29703 10.05 6.43998 10.5213 6.43998 11.0034C6.43998 11.6498 6.18318 12.2698 5.72606 12.7269C5.26894 13.1841 4.64895 13.4409 4.00249 13.4409ZM14.5025 20.1909C14.0204 20.1909 13.5491 20.0479 13.1483 19.7801C12.7474 19.5122 12.435 19.1316 12.2505 18.6862C12.066 18.2408 12.0178 17.7507 12.1118 17.2778C12.2059 16.805 12.438 16.3707 12.7789 16.0298C13.1198 15.6889 13.5541 15.4568 14.027 15.3627C14.4998 15.2687 14.9899 15.3169 15.4353 15.5014C15.8807 15.6859 16.2614 15.9983 16.5292 16.3992C16.797 16.8 16.94 17.2713 16.94 17.7534C16.94 18.0735 16.8769 18.3904 16.7544 18.6862C16.6319 18.9819 16.4524 19.2506 16.2261 19.4769C15.9997 19.7033 15.731 19.8828 15.4353 20.0053C15.1395 20.1278 14.8226 20.1909 14.5025 20.1909Z" fill="currentColor"/>
                        </svg>
                        <svg class="article-hero__share-button--check" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                        </svg>

                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
