<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        <!-- <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/bootstrap/bootstrap.css"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/icons/fontawesome/styles.min.css"> -->
        <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/style.css">
        <!-- <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/basic.css"> -->
        <!-- <link rel="stylesheet" href="<?php echo URL::to('/'); ?>/assets/css/responsive.css"> -->
        <!-- <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"> -->
        <!-- <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css"> -->
        <style type="text/css">
            

            /*.item1 {
              grid-column: 1 / 5;
            }*/

            .about{
                position: absolute;
                left: 0%;
                right: 0%;
                top: 0%;
                bottom: 0%;

                /* white */

                background: #FFFFFF;
            }

            .about-in{
                position: absolute;
                left: 10.42%;
                right: 10.42%;
                top: 0%;
                bottom: 0%;

                background: #FFFFFF;
            }
            
            .img-about{
                position: absolute;
                left: 10.42%;
                right: 58.47%;
                top: 8.47%;
                bottom: 13.27%;
            }
            .text-about{
                position: absolute;
                left: 47.57%;
                right: 10.49%;
                top: 19.49%;
                bottom: 13.28%;

                font-family: Roboto;
                font-style: normal;
                font-weight: bold;
                font-size: 14px;
                line-height: 16px;

                color: #414042;
            }

            .grid1 {
              grid-column: 1 / span 3 !important;
            }

            .grid2 {
              grid-column: 4 / span 3 !important;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td>
                    @if($about->image == null)
                    <img class="grid1" class="img-about" src="<?php echo URL::to('/'); ?>/assets/img/img-about.jpg">
                    @else
                    <img class="grid1" class="img-about" src="{{$about->image}}" >
                    @endif
                </td>
                <td>
                    <?= $about->about; ?>
                </td>
            </tr>
        </table>
    </body>
</html>
