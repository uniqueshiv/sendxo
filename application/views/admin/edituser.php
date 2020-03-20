<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Edit user</h4>
                    <form method="POST">
                        <input type="hidden" name="action" value="edit_user">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail" value="<?php echo $user['email'] ?>" required><br>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required><br>
                        </div>
                        <input type="submit" class="btn btn-success" value="Edit user">
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>