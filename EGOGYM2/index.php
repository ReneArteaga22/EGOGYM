<!DOCTYPE html>
<html lang="en">
<head>

     <title>EGOGYM</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- SCRIPTS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/aos.js"></script>
      <script src="js/smoothscroll.js"></script>
      <script src="js/custom.js"></script>

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/egogym.css">

     <style>
        .zoomable {
          transition: transform 0.3s;
        }
    
        .zoomable:hover {
          transform: scale(1.06);
        }
    
        .button {
        position: bottom;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: orange;
        padding: 10px 20px;
        color: white;
        font-weight: bold;
        text-decoration: none;
        }

        .class-thumb:hover .service-info a {
        color: orange; /* Cambia el color a tu elección */
        }

</style>

  
</head>
<body data-spy="scroll" data-target="#navbarNav" data-offset="50">

    <!-- MENU BAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">

            <a class="navbar-brand" href="index.html">EGO GYM</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link smoothScroll">Home</a>
                    </li>

                    <li class="nav-item">
                        <a href="#about" class="nav-link smoothScroll">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="#serv" class="nav-link smoothScroll">Servicios</a>
                    </li>

                    <li class="nav-item">
                        <a href="#schedule" class="nav-link smoothScroll">Calendario</a>
                    </li>

                    <li class="nav-item">
                        <a href="#contact" class="nav-link smoothScroll">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <!---->
                        <div class="btn-group-sm"> 
                            <a href="#" class="btn btn-sm custom-btn bg-color "  data-toggle="modal" data-target="#membershipForm">Inicia Sesión</a> 
                    </li>
                </ul>

            </div>

        </div>
    </nav>


     <!-- HERO -->
     <section class="hero d-flex flex-column justify-content-center align-items-center" id="home">

            <div class="bg-overlay"></div>

               <div class="container">
                    <div class="row">

                         <div class="col-lg-8 col-md-10 mx-auto col-12">
                              <div class="hero-text mt-5 text-center">

                                    <h6 data-aos="fade-up" data-aos-delay="300">Adopta un nuevo estilo de vida más saludable!</h6>

                                    <h1 class="text-white" data-aos="fade-up" data-aos-delay="500">Mejora tu cuerpo en EGOGYM Fitness Club</h1>

                                    <a href="#feature" class="btn custom-btn mt-3" data-aos="fade-up" data-aos-delay="600">Empieza ya</a>

                                    <a href="#about" class="btn custom-btn bordered mt-3" data-aos="fade-up" data-aos-delay="700">Mas sobre nosotros</a>
                                   
                              </div>
                         </div>

                    </div>
               </div>
     </section>


     <section class="feature" id="feature">
        <div class="container">
            <div class="row">

                <div class="d-flex flex-column justify-content-center ml-lg-auto mr-lg-5 col-lg-5 col-md-6 col-12">
                    <h2 class="mb-3 text-white" data-aos="fade-up">¿Nuevo en el gimnasio?</h2>

                    <h6 class="mb-4 text-white" data-aos="fade-up">Ven a EGOGYM y la inscripción es gratis (Mensualidad el mes de Agosto en $399)</h6>

                    <p data-aos="fade-up" data-aos-delay="200">Conviertete en miembro de nuestro gimnasio y accede a los diferentes <a href="#serv">SERVICIOS </a>con los que contamos. Entrena ahora y eleva tu EGO.</p>

                    <a href="#" class="btn custom-btn bg-color mt-3" data-aos="fade-up" data-aos-delay="300" data-toggle="modal" data-target="#registro">Registrate ahora</a>
                </div>

                <div class="mr-lg-auto mt-3 col-lg-4 col-md-6 col-12">
                     <div class="about-working-hours">
                          <div>

                                <h2 class="mb-4 text-white" data-aos="fade-up" data-aos-delay="500">Horarios del Gym</h2>

                               <strong class="d-block" data-aos="fade-up" data-aos-delay="600">Domingos : Cerrado</strong>

                               <strong class="mt-3 d-block" data-aos="fade-up" data-aos-delay="700">Lunes - Viernes</strong>

                                <p data-aos="fade-up" data-aos-delay="800">6:00 AM - 11:00 PM</p>

                                <strong class="mt-3 d-block" data-aos="fade-up" data-aos-delay="700">Sabados</strong>

                                <p data-aos="fade-up" data-aos-delay="800">6:00 AM - 3:00 PM</p>
                               </div>
                          </div>
                     </div>
                </div>

            </div>
        </div>
    </section>


     <!-- ABOUT -->
     <section class="about section" id="about">
               <div class="container">
                    <div class="row">
                    <div class="mt-lg-5 mb-lg-0 mb-4 col-lg-5 col-md-10 mx-auto col-12">
                            <h2 class="mb-4" data-aos="fade-up" data-aos-delay="300">Contamos con profesionales en el ambito deportivo</h2>

                            <p data-aos="fade-up" data-aos-delay="400">Ven y entrena en nuestra area de pesas, con nuestros entrenadores de box o agenda una cita en cualquiera de nuestros servicios<p>

                            

                        </div>

                        <div class="ml-lg-auto col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="700">
                            <div class="team-thumb">
                                <img src="images/class/boxwax.jpg" class="img-fluid" alt="Trainer">

                                <div class="team-info d-flex flex-column">

                                    <h3>WAX Guerrero</h3>
                                    <span>Entrenador de Box</span>

                                   
                                </div>
                            </div>
                        </div>

                        <div class="mr-lg-auto mt-5 mt-lg-0 mt-md-0 col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="800">
                            <div class="team-thumb">
                                <img src="images/class/eliasego.jpg" class="img-fluid" alt="Trainer">

                                <div class="team-info d-flex flex-column">

                                    <h3>Elias Hurtado</h3>
                                    <span>Entrenador y preparador físico</span>

                                    
                                </div>
                            </div>
                        </div>


                    </div>
               </div>
     </section>


     <!-- CLASS -->
     <section class="class section" id="serv">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-12 text-center mb-3">
              <h2 data-aos="fade-up" data-aos-delay="200">Toma control e inscribete a nuestros servicios</h2>
            </div>
            
            <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="400">
              <div class="class-thumb zoomable">
                <div class="service-wrapper">
                  <a href="nutriologo.html">
                  <img src="images/class/nutri.jpg" class="img-fluid" alt="Class">
                  <div class="service-info">
                    <a href="nutriologo.html"><h3 class="mb-1">Nutricion</h3></a>
                    <span><strong>Nutriólogo:</strong> - Cesar Ruiz</span>
                    <span class="class-price">$100</span>
                    <p class="mt-3">Los suplementos alimenticios se han convertido en un recurso muy popular. Con grandes avances e investigacion...</p>
                  </div>
                </div>
              </div>
            </div>
            
              
    
            <div class="mt-5 mt-lg-0 mt-md-0 col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="500">
              <div class="class-thumb zoomable">
                <div class="service-wrapper">
                  <a href="fisioterapia.html">
                  <img src="images/class/fisio.jpg" class="img-fluid" alt="Class">
                  <div class="service-info">
                    <a href="fisioterapia.html"><h3 class="mb-1">Fisioterapia</h3></a>
                    <span><strong>Fisioterapeuta:</strong> - Cesar Ruiz</span>
                    <span class="class-price">$100</span>
                    <p class="mt-3">Un fisioterapeuta deportivo no sólo cura sobre la lesión, sino que asesorar a los deportistas ... </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-5 mt-lg-0 col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="600">
              <div class="class-thumb zoomable">
                <div class="service-wrapper">
                  <a href="spinning.html">
                  <img src="images/class/spinm.jpg" class="img-fluid" alt="Class">
                  <div class="service-info">
                    <a href="spinning.html"><h3 class="mb-1">Spinning</h3></a>
                    <span><strong>Entrenador:</strong> Marcos Camacho</span>
                    <span class="class-price">$100</span>
                    <p class="mt-3">El spinning es un ejercicio cardiovascular y aeróbico que se lleva a cabo utilizando una bicicleta estática ...</p>
                  </div>
                </div>
              </div>
            </div>

    
          </div>
        </div>
      </section>



     <!-- SCHEDULE -->
     <section class="schedule section" id="schedule">
               <div class="container">
                    <div class="row">

                            <div class="col-lg-12 col-12 text-center">
                                <h6 data-aos="fade-up">Cronograma de clases</h6>

                                <h2 class="text-white" data-aos="fade-up" data-aos-delay="200"></h2>
                             </div>

                             <div class="col-lg-12 py-5 col-md-12 col-12">
                                 <table class="table table-bordered table-responsive schedule-table" data-aos="fade-up" data-aos-delay="300">

                                     <thead class="thead-light">
                                         <th><i class="fa fa-calendar"></i></th>
                                         <th>Lun</th>
                                         <th>Mar</th>
                                         <th>Mier</th>
                                         <th>Jue</th>
                                         <th>Vier</th>
                                         
                                     </thead>

                                     <tbody>
                                         <tr>
                                            <td><small>7:00 pm</small></td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>7:00 pm - 7:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>7:00 pm - 7:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>7:00 pm - 7:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>7:00 pm - 7:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning</strong>
                                                <span>7:00 pm - 7:50 pm</span>
                                            </td>
                                         </tr>

                                         <tr>
                                            <td><small>8:00 pm</small></td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>8:00 pm - 8:50 pm</span>
                                            </td>
                                           <td>
                                                <strong>Spinning y Box</strong>
                                                <span>8:00 pm - 8:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>8:00 pm - 8:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>8:00 pm - 8:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>8:00 pm - 8:50 pm</span>
                                            </td>
                                         </tr>

                                         <tr>
                                            <td><small>09:00 pm</small></td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>9:00 pm - 9:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>9:00 pm - 9:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>9:00 pm - 9:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>9:00 pm - 9:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>9:00 pm - 9:50 pm</span>
                                            </td>
                                         </tr>

                                         <tr>
                                            <td><small>10:00 pm</small></td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>10:00 pm - 10:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>10:00 pm - 10:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>10:00 pm - 10:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>10:00 pm - 10:50 pm</span>
                                            </td>
                                            <td>
                                                <strong>Spinning y Box</strong>
                                                <span>10:00 pm - 10:50 pm</span>
                                            </td>
                                           
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>

                    </div>
               </div>
     </section>

     <!-- CONTACT -->
     <section class="contact section" id="contact">
          <div class="container">
               <div class="row">

                     
                    <div class="mx-auto mt-4 mt-lg-0 mt-md-0 col-lg-5 col-md-6 col-12">
                      <h2 class="mb-4" data-aos="fade-up" data-aos-delay="600">Tu opinion <span>nos interesa</span></h2>
                      
                <ul class="social-icon ml-lg-3">
                    <li><a href="https://www.facebook.com/egogymclub" class="fa fa-facebook" style="color: goldenrod;"></a>Facebook EGOGYM</li>
                    <li><a href="#" class="fa fa-twitter" style="color: goldenrod;"></a>Twitter EGOGYM</li>
                    <li><a href="#" class="fa fa-instagram" style="color: goldenrod;"></a>Siguenos en instagram</li>
                </ul>

                <br>
                
                <img src="images/class/Sugerencias y quejas.jpg" class="img-fluid" alt="Class">
                    </div>

                    <div class="mx-auto mt-4 mt-lg-0 mt-md-0 col-lg-5 col-md-6 col-12">
                        <h2 class="mb-4" data-aos="fade-up" data-aos-delay="600">Donde nos <span>encontramos</span></h2>

                        <p data-aos="fade-up" data-aos-delay="800"><i class="fa fa-map-marker mr-1" style="color: goldenrod;"></i> Calz Salvador Creel 56, Las Margaritas, 27130 Torreón, Coah.</p>
<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
                        <div class="google-map" data-aos="fade-up" data-aos-delay="900">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d636.2591289677584!2d-103.44351214827108!3d25.56417483599099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdb22cc71d329%3A0x69bf515e20ae8a00!2sEgo%20Gym%20club!5e0!3m2!1ses!2smx!4v1689127849312!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    
               </div>
          </div>
     </section>


     <footer class="site-footer" style="background-color: #0c0c0c;">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                  <!-- Enlace del logotipo que te llevará al inicio de la página -->
                  <a href="index.html" class="logo-link" style="display: flex; justify-content: center;">
                      <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden;">
                          <img src="images/class/logo4.jpg" alt="Logo EGOGYM" style="width: 100%; height: 100%; object-fit: cover;">
                      </div>
                  </a>
              </div>
          </div>
          <div class="row">
              <div class="col-12 text-center">
                  <!-- Texto de derechos reservados -->
                  <p class="rights-text" style="color: white;">Todos los derechos reservados EGOGYM 2023</p>
              </div>
          </div>
      </div>
  </footer>
  
  
  
  

    <!-- Modal -->
    <div class="modal fade" id="membershipForm" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

        <div class="modal-content">
          <div class="modal-header">

            <h2 class="modal-title" id="membershipFormLabel">Inicia Sesión</h2>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form class="membership-form webform" role="form" action="scripts/verificaLogin.php" method="post">
                

                <input type="email" class="form-control" name="email" placeholder="Escribe tu correo" required>

                <input type="password" class="form-control" name="contraseña" placeholder="Escribe tu contraseña" required>


                <button type="submit" class="form-control" id="submit-button" name="submit">Ingresar</button>
                <p>¿No tienes sesión?</p><a href="#" data-toggle="modal" data-target="#registro">¡Registrate!</a>
                
            </form>
          </div>

          <div class="modal-footer"></div>

          

        </div>
      </div>
    </div>
    <div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="membershipFormLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
  
          <div class="modal-content">
            <div class="modal-header">
  
              <h2 class="modal-title" id="membershipFormLabel">Crea un perfil</h2>
  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
  
            <d class="modal-body">
              <form class="membership-form webform" role="form" action="scripts/guardauser.php" method="post">
                  
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                  <input type="text" class="form-control" name="ap_paterno" placeholder="Apellido Paterno" required>
                  <input type="text" class="form-control" name="ap_materno" placeholder="Apellido Materno" required>
                  <input type="email" class="form-control" name="correo" placeholder="Escribe tu correo" required>
                  <input type="password" class="form-control" name="contraseña" placeholder="Escribe tu contraseña" required>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="inlineRadio1" value="1" required>
                    <label class="form-check-label" for="inlineRadio1">Hombre</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">Mujer</label>
                  </div>
                  <input type="date" class="form-control" name="fecha_nacimiento" required min="1950-01-01" max="2015-01-01">
                  <button type="submit" class="form-control" id="submit-button" name="submit">Guardar</button>
                  
                  
              </form>
            </div>
  
            <div class="modal-footer"></div>
  
            
  
          </div>
        </div>
      </div>
  

    

</body>
</html>