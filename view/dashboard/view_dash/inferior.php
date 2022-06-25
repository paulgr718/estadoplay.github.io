   </div>
   <!-- End of Main Content -->

   <!-- Footer -->
   <footer class="sticky-footer bg-white">
       <div class="container my-auto">
           <div class="copyright text-center my-auto">
               <span>Copyright &copy; Estado Play 2022</span>
           </div>
       </div>
   </footer>
   <!-- End of Footer -->

   </div>
   <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
       <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <a class="btn btn-primary" href="login.html">Logout</a>
               </div>
           </div>
       </div>
   </div>


   
   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>

   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/chart.js/Chart.min.js"></script>
   <script src="vendor/chart.js/Chart.bundle.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/chart-area-demo.js"></script>
   <script src="js/demo/chart-pie-demo.js"></script>


   <!-- jQuery, Popper.js, Bootstrap JS -->

   <script src="popper/popper.min.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>





   <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
   <!--<script type="text/javascript" src="js/js_crudDisp.js"> </script>
<script type="text/javascript" src="js/js_crudTip.js"> </script>-->

   <script type="text/javascript" src="../../controlador/ctl_dispositivos.js"> </script>
   <script type="text/javascript" src="../../controlador/ctl_dispositivo_tipo.js"> </script>
   <script type="text/javascript" src="../../controlador/ctl_categorias.js"></script>

   <script type="text/javascript" src="../../controlador/ctl_sub_categoria.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_producto.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_dashboard.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_deuda.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_detalleDeuda.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_clientes.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_gananciaM.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_gananciasHoy.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_control_dispositivos.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_ventCli.js"></script>
   <script type="text/javascript" src="../../controlador/ctl_mostrarVenta.js"></script>
<script type="text/javascript" src="js/ventas.js"></script>
   <script type="text/javascript" src="js/funcion_tp.js"></script>

   <script src="js/timer.jquery.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>



   <script>
       function muestraReloj() {
           var fechaHora = new Date();
           var horas = fechaHora.getHours();
           var minutos = fechaHora.getMinutes();
           var segundos = fechaHora.getSeconds();

           var sufijo = ' am';
           if (horas > 12) {
               horas = horas - 12;
               sufijo = ' pm';
           }

           if (horas < 10) {
               horas = '0' + horas;
           }
           if (minutos < 10) {
               minutos = '0' + minutos;
           }
           if (segundos < 10) {
               segundos = '0' + segundos;
           }

           document.getElementById("tiempo").innerHTML = horas + ':' + minutos + ':' + segundos + sufijo;
       }
       window.onload = function() {
           setInterval(muestraReloj, 1000);
       }
   </script>
   <script>
       var diaSe = new Array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");

       var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
       var f = new Date();
       var dia = f.getDate();
       var mes2 = f.getMonth();
       var mes = meses[f.getMonth()];
       var anio = f.getFullYear();
       var year = f.getFullYear();
       var diaS = diaSe[f.getDay()];
       /*document.getElementById("fecha").innerHTML = (f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());*/
       document.getElementById("fecha").innerHTML = diaS + ", " + dia + " de " + mes + " del " + year;
       document.getElementById("fecha2").innerHTML = " " + dia + "/" + mes2 + "/" + year;
       document.getElementById("fecha3").innerHTML = " (" + mes + ")";
       document.getElementById("fechahoy").innerHTML = dia + "/" + mes2 + "/" + year;
   </script>




   </body>

   </html>