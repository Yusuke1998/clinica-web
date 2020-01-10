@extends('layouts.website')
@section('content')
<!-- Section: intro -->
<section id="intro" class="intro">
    <div class="intro-content">
        <div class="container">
            <v-carousel  
                :autoplay="true"
                autoplay_speed="3"
                :nav="false"
                :margin="10"
                :items="4">
                <div v-for="(v,index) in 'mariaa'" class="panel">
                    <div class="panel-body">
                        <img :src="$root.base_url+'website/img/photo/'+(index+1)+'.jpg'">
                    </div>
                    <div class="panel-footer">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                    </div>
                </div>
                
            </v-carousel>
        </div>
    </div>      
</section>
<!-- /Section: intro -->

<!-- Section: servicios -->
<section id="servicios" class="home-section nopadding paddingtop-60">
    <div class="container">
        <h4>Servicios</h4>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                <img src="{{ asset('website/img/dummy/img-1.jpg') }}" class="img-responsive" alt="" />
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-stethoscope fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Medical checkup</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-wheelchair fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Nursing Services</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.3s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-plus-square fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Pharmacy</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-h-square fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Gyn Care</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-filter fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Neurology</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.3s">
                    <div class="service-box">
                        <div class="service-icon">
                            <span class="fa fa-user-md fa-3x"></span> 
                        </div>
                        <div class="service-desc">
                            <h5 class="h-light">Sleep Center</h5>
                            <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</section>
<!-- /Section: servicios -->

<section id="noticias-eventos" class="home-section nopadding paddingtop-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h4>Noticias</h4>
                <!-- noticias -->
                <div class="media" v-for="(v,index) in 'vainas'">
                  <div class="media-left">
                    <a href="#">
                      <img width="190" class="media-object" :src="$root.base_url+'website/img/photo/'+(index+1)+'.jpg'" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <small>1<span v-text="(index+1)"></span> DIC 2019 | SALUD</small>
                    <h5 class="media-heading">Media heading</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                  </div>
                </div>
                <!-- /noticias -->
            </div>
            <div class="col-md-4">
                <!-- eventos -->
                <h4>Eventos</h4>
                <ul class="list-group">
                  <li class="list-group-item">Cras justo odio</li>
                  <li class="list-group-item">Dapibus ac facilisis in</li>
                  <li class="list-group-item">Morbi leo risus</li>
                  <li class="list-group-item">Porta ac consectetur ac</li>
                  <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <!-- /eventos -->
            </div>
        </div>
    </div>
</section>

<!-- Section: contactos -->
<section id="contactos" class="home-section nopadding paddingtop-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="">
                    
                </form>
            </div>
        </div>      
    </div>
</section>
<!-- /Section: contactos -->
@stop