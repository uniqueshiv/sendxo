        </section>
        <div class="modal fade" id="modalCleardb" tabindex="-1" role="dialog" aria-labelledby="modalCleardbLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalCleardbLabel">Clear database</h4>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <li class="fa fa-exclamation-triangle fa-5x"></li>
                        <p style="padding-top: 10px;">Are you sure you want to delete all the data from your database ? This will include Upload, files and Download data.</p>
                        <p><b>Warning !</b> This will not delete any uploaded files on your server</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a type="button" href="action.php?action=cleardb" class="btn btn-primary">Clear DB</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddUserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalAddUserLabel">Add user</h4>
                    </div>
                    <form id="createUser" action="action.php" method="POST">
                        <input type="hidden" name="action" value="create_user">
                        <div class="modal-body">
                            <div id="userError"></div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="E-Mail">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success" id="submitAddUser">Add user</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../assets/js/admin/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../assets/js/admin/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../assets/js/admin/jquery.scrollTo.min.js"></script>
        <script src="../assets/js/admin/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../assets/js/admin/jquery.sparkline.js"></script>
        <!--common script for all pages-->
        <script src="../assets/js/admin/common-scripts.js"></script>

        <!--script for this page-->
        <script src="../assets/js/admin/sparkline-chart.js"></script>
        <script src="../assets/js/admin/zabuto_calendar.js"></script>
        </body>
</html>