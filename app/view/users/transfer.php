<?php require APPROOT .'/view/include/header'. '.php';?> 
<section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row" style="margin-top: 20px;">
				<div class="col-lg-12">
					<ol class="breadcrumb">
						<li><a href="index.html">User</a></li>
						<li><i class="fa fa-arrow-up"></i>Transfer Money</li>						  	
					</ol>
				</div>
			  </div>

<!-- Form validations -->              
              <div class="row">
                  <div class="col-lg-6 col-lg-offset-3">
                      <section class="panel">
                          <header class="panel-heading">
                              Wire a Transfer to beneficiary 
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="<?php echo URLROOT;?>/users/transfer/<?php echo $data['id'];?>">
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">TransactionID:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['tid_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="tid" readonly value="<?php echo $data['tid'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['tid_err'];?></span>
                                          </div>
                                      </div>
                                      <input type="hidden" name="status" value="debit">
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">Acc Name:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['acc_name_err'])) ? 'is-invalid' : ''; ?>" id="subject" placeholder="beneficiary account name" name="acc_name" value="<?php echo $data['acc_name'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['acc_name_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">Acc Number:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['acc_num_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="acc_num" placeholder="beneficiary account number" value="<?php echo $data['acc_num'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['acc_num_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">Amount:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="amount" value="<?php echo $data['amount'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['amount_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">Current Bal:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['current_bal_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="cb" readonly value="<?php echo $data['current_bal'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['current_bal_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="name" class="control-label col-lg-3">Available Bal:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['avail_bal_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="ab" readonly value="<?php echo $data['avail_bal'];?>" minlength="5" type="text" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['avail_bal_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="password" class="control-label col-lg-3">Pin:<span class="required">*</span></label>
                                          <div class="col-lg-9">
                                              <input class="form-control <?php echo (!empty($data['pin_err'])) ? 'is-invalid' : ''; ?>" id="subject" name="pin" placeholder="secret pin" value="<?php echo $data['pin'];?>" minlength="5" type="password" required /><span class="invalid-feedback" style="color:red;"><?php echo $data['pin_err'];?></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit">Process</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                    </div>
               </div>


		  </section>
</section>
<?php require APPROOT .'/view/include/footer'. '.php';?> 