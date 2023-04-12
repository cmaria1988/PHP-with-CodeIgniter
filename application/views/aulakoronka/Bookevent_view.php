<div class="content-wrapper">
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h4 class="page-title">Book Event</h4>
      </div>
    </div>
  </div>
  <?php
  if (isset($message)) {
    echo '<div class="alert alert-danger alert-dismissible">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <strong>' . $message[1] . '</strong>
						</div>';
  }
  ?>

  <div id='divform'>
    <?php echo form_open('aulakoronka/Bookevent/save'); ?>

    <div class="row form-group">
      <div class="col-sm-1"><input type='button' class='btn btn-info btn-sm' value='Show Event List' id='carievid' onclick="carieventid()"></div>
    </div>
    <hr>
  </div>

  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Event ID (*)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="eventid" name="eventid" placeholder="Event ID" required readonly value='<?php if (isset($dataEvent)) echo $dataEvent['eventid']; ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Customer Name/Telp (*)</label>
    <div class="col-sm-5">
      <select name='customerid' id='customerid' class='form-control'>
        <option value=""></option>
        <?php
        echo $dataEvent;
        foreach ($listcustomer as $customer) :
        ?>
          <option value='<?php echo $customer['customerid']; ?>' <?php if (isset($dataEvent) && $dataEvent['customerid'] == $customer['customerid']) echo "selected"; ?>><?php echo $customer['name'] . ' - (' . $customer['telp'] . ')'; ?></option>
        <?php
        endforeach;
        ?>
      </select>
    </div>
  </div>

  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Event Category / Price (*)</label>
    <div class="col-sm-5">
      <select name='categoryid' id='categoryid' class='form-control'>
        <option value=""></option>
        <?php
        foreach ($listcategory as $category) :
        ?>
          <option value='<?php echo $category['categoryid']; ?>' <?php if (isset($dataEvent) && $dataEvent['categoryid'] == $category['categoryid']) echo "selected"; ?>><?php echo $category['category'] . ' - (Rp.' . $this->mylib->rupiah($category['price']) . ')'; ?></option>
        <?php
        endforeach;
        ?>
      </select>
    </div>
  </div>

  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Date (*)</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="tglevent" name="tglevent" placeholder="Date" required readonly value='<?php if (isset($dataEvent)) echo $dataEvent['date']; ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Guests</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="shownop" name="shownop" placeholder="Number of People" value='<?php if (isset($dataEvent)) echo $dataEvent['numberofpeople']; ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Theme</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="showtheme" name="showtheme" placeholder="Theme" value='<?php if (isset($dataEvent)) echo $dataEvent['theme']; ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Vendor</label>
    <div class="col-sm-5">
      <textarea type="text" class="form-control" id="showvendor" name="showvendor" placeholder="Vendor"><?php if (isset($dataEvent)) echo $dataEvent['vendor']; ?></textarea>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Information</label>
    <div class="col-sm-5">
      <textarea type="text" class="form-control" id="showinfo" name="showinfo" placeholder="Information"><?php if (isset($dataEvent)) echo $dataEvent['information']; ?></textarea>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Start</label>
    <div class="col-sm-5">
      <input type="time" class="form-control" id="showstart" name="showstart" placeholder="Start" value='<?php if (isset($dataEvent)) echo $dataEvent['start']; ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Discount</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="showdiscount" name="showdiscount" placeholder="Discount" value='<?php if (isset($dataEvent)) echo $this->mylib->rupiah($dataEvent['discount']); ?>'>
    </div>
  </div>
  <div class="row form-group">
    <label for="nama" class="col-sm-3 control-label">Total Paid</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="showpaid" name="showpaid" placeholder="Total Paid" required readonly value='<?php if (isset($dataEvent)) echo $this->mylib->rupiah($dataEvent['payment']); ?>'>
    </div>
  </div>




  <?php  if (!isset($dataEvent) || (isset($dataEvent) && $dataEvent['payment'] < $dataEvent['price'])) { ?>
    <div class="row form-group">
      <label for="nama" class=><b>Show Payment &nbsp;</b></label>
      <input type="checkbox" id="checkpayment" name="checkpayment" placeholder="Show Payment" onclick="checkedpayment()">
    </div>

    <div id="divpopuppayment" style="display: none;">
      <?php if (isset($dataEvent) && $dataEvent['payment'] < $dataEvent['price']) { ?>
        <div class="row form-group">
          <label for="nama" class="col-sm-3 control-label">Remaining Payment</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="remainpayment" name="remainpayment" placeholder="Remaining Payment" value='<?php echo $this->mylib->rupiah($dataEvent['remainpayment']) ?>'>

          </div>
          <div class="col-sm-1">
            <input type='button' class='btn btn-info btn-sm' value='Show Payment List' id='showpaymentlist' onclick="paymentlist()">
          </div>
        </div>
      <?php } ?>

      <div class="row form-group">
        <label for="nama" class="col-sm-3 control-label">Payment Amount (*)</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="showaddpayment" name="showaddpayment" placeholder="Payment Amount">
        </div>
      </div>
      <div class="row form-group">
        <label for="nama" class="col-sm-3 control-label">Payment Method (*)</label>
        <div class="col-sm-5">
          <input type="radio" id="cash" name="paymentmethod" value="1" placeholder="Cash">
          <label for="cash">Cash</label>
          <input type="radio" id="transfer" name="paymentmethod" value="2" placeholder="transfer">
          <label for="transfer">Transfer</label>
        </div>
      </div>
      <div class="row form-group">
        <label for="nama" class="col-sm-3 control-label">Payment Detail</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control" id="paymentdetail" name="paymentdetail" placeholder="Payment Detail"></textarea>
        </div>
        <?php if (isset($dataEvent)) {  ?>
          <div class="col-sm-1">
            <input type='submit' class='btn btn-info btn-sm' value='Add Payment' id='addpayment' name="addpayment" id="addpayment">
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <?php
  if (isset($dataEvent)) {
    $neventid = $dataEvent['eventid'];
  ?>
    <input type="submit" class="btn btn-primary  btn-sm" name="tblubah" id="tblubah" value="Update">
    <input type="submit" class="btn btn-primary  btn-sm" name="tblhapus" id="tblhapus" value="Hapus Event">
  <?php
  } else {
  ?>
    <input type="submit" class="btn btn-primary btn-sm" name="tblsimpan" id="tblsimpan" value="Save">

  <?php
  }
  ?>
  <input type="button" class="btn btn-primary btn-sm" name="tblreset" id="tblreset" value="Reset" onclick='backbutton()'>

</div>
</div>
<?php echo form_close(); ?>
</div>

<!-- pop up event-->
<div class="modal fade" id="divpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog wide-modal">
    <div class="modal-content" style="width: 1000px;">
      <div class=" modal-header">
        <h4 class="modal-title" id="myModalLabel">Pilih Event</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Event ID" title="Type Event ID"><br>
        <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search for Date" title="Type Date"><br>
        <input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search for Customer" title="Type Customer Name"><br><br>
        <table class="table table-bordered table-condensed table-hover table-striped" id='tabelpopfpb'>
          <thead>
            <tr>
              <th>Event ID</th>
              <th>Tgl</th>
              <th>Customer</th>
              <th>Telp</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($listdataevent as $event) :
            ?>
              <tr>
                <td><?php echo $event['eventid']; ?></td>
                <td><?php echo $this->mylib->tglIndo($event['date']); ?></td>
                <td><?php echo $event['name']; ?></td>
                <td><?php echo $event['telp']; ?></td>
                <td><input type='button' class='btn btn-primary btn-xs' value='Pilih' onclick="pilihevent('<?php echo $event['eventid']; ?>')"></td>
              </tr>
            <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- pop up event2-->
<div class="modal fade" id="divpopup2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog wide-modal">
    <div class="modal-content" style="width: 800px;">
      <div class=" modal-header">
        <h4 class="modal-title" id="myModalLabel">Payment List for Event: <?php echo $dataEvent['eventid'] ?></h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-condensed table-hover table-striped" id='tabelpopfpb'>
          <thead>
            <tr>
              <th>Date</th>
              <th>Payment Method</th>
              <th>Detail</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($listpayment as $payment) :
            ?>
              <tr>
                <td><?php echo $this->mylib->tglIndo($payment['date']); ?></td>
                <td><?php echo $payment['paymentmethod'] == 1 ? "Cash" : "Bank Transfer" ?></td>
                <td><?php echo $payment['information']; ?></td>
                <td align="right"><?php echo $this->mylib->rupiah($payment['amount']); ?></td>
              </tr>
            <?php
            endforeach;
            ?>
            <tr>
              <td colspan="3" align="right">Total Paid :</td>
              <td align="right"><?php echo $this->mylib->rupiah($dataEvent['payment']); ?></td>
            </tr>
            <tr>
              <td colspan="3" align="right" style="color: blue;">Discount :</td>
              <td align="right" style="color: blue;"><?php echo "-" . $this->mylib->rupiah($dataEvent['discount']); ?></td>
            </tr>
            <tr>
              <td colspan="3" align="right">Package Price :</td>
              <td align="right"><?php echo $this->mylib->rupiah($dataEvent['price']); ?></td>
            </tr>
            <tr>
              <td colspan="3" align="right"><b>Remaining Payment :</b></td>
              <td align="right"><b><?php echo $this->mylib->rupiah($dataEvent['remainpayment']); ?></b></td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>