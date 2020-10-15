 <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SMA Katolik Frateran Surabaya</span>
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
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Tekan logout untuk keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <?php if($this->session->userdata('kr_jabatan_id')<8){
            echo '<a class="btn btn-primary" href="'.base_url('auth/logout').'">Logout</a>';
          }else{echo '<a class="btn btn-primary" href="'.base_url('login_siswa/logout').'">Logout</a>';}?>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/'); ?>js/printThis.js"></script>
  <script src="<?= base_url('assets/'); ?>js/allJs.js"></script>
  <script src="<?= base_url('assets/'); ?>js/jquery.waypoints.min.js"></script>
  <script src="<?= base_url('assets/'); ?>js/sticky.min.js"></script>

</body>

</html>
