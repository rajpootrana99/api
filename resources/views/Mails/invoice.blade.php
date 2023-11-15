<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Redressed&family=Ubuntu:wght@400;700&display=swap");

    :root {
      --bg-clr: #ead376;
      --white: #fff;
      --primary-clr: #2f2929;
      --secondary-clr: #F96D22;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Ubuntu", sans-serif;
    }

    body {
      background: var(--bg-clr);
      font-size: 12px;
      line-height: 20px;
      color: var(--primary-clr);
      padding: 0 20px;
    }

    .invoice {
      width: 600px;
      max-width: 100%;
      height: auto;
      background: var(--white);
      padding: 50px 60px;
      position: relative;
      margin: 20px auto;
    }

    .w_15 {
      width: 15%;
    }

    .w_50 {
      width: 50%;
    }

    .w_55 {
      width: 55%;
    }

    .p_title {
      font-weight: 700;
      font-size: 14px;
    }

    .i_row {
      display: flex;
    }

    .text_right {
      text-align: right;
    }

    .invoice .header .i_row {
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .invoice .header .i_row:last-child {
      align-items: flex-end;
    }

    .invoice .header .i_row .i_logo p {
      font-family: "Redressed", cursive;
    }

    .invoice .header .i_row .i_logo p,
    .invoice .header .i_row .i_title h2 {
      font-size: 32px;
      line-height: 38px;
      color: var(--secondary-clr);
    }

    .invoice .header .i_row .i_address .p_title span {
      font-weight: 400;
      font-size: 12px;
    }

    .invoice .body .i_table .i_col p {
      font-weight: 700;
    }

    .invoice .body .i_table .i_row .i_col {
      padding: 12px 5px;
    }

    .invoice .body .i_table .i_table_head .i_row {
      border: 2px solid;
      border-color: var(--primary-clr) transparent var(--primary-clr) transparent;
    }

    .invoice .body .i_table .i_table_body .i_row:last-child {
      border-bottom: 2px solid var(--primary-clr);
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap {
      margin-top: 20px;
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total {
      background: var(--secondary-clr);
      color: var(--white);
      padding: 10px 15px;
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total p {
      display: flex;
      justify-content: space-between;
    }

    .invoice .footer {
      margin-top: 30px;
    }
  </style>
</head>
<body>

<section>
  <div class="invoice">
    <div class="header">
      <div class="i_row">
        <div class="i_logo">
          <p>{{ $invoice->task->title }}</p>
        </div>
        <div class="i_title">
          <h2>INVOICE</h2>
          <p class="p_title text_right">
            {{ $invoice->issue_date }}
          </p>
        </div>
      </div>
      <div class="i_row">
        <div class="i_number">
          <p class="p_title">INVOICE NO: {{ $invoice->id }}</p>
        </div>
        <div class="i_address text_right">
          <p>TO</p>
          <p class="p_title">
          {{ $invoice->entity->entity }} <br />
            <span>{{ $invoice->entity->address }}</span><br />
            <span>{{ $invoice->entity->primary_phone }}</span>
          </p>
        </div>
      </div>
    </div>
    <div class="body">
      <div class="i_table">
        <div class="i_table_head">
          <div class="i_row">
            <div class="i_col w_15">
              <p class="p_title">QTY</p>
            </div>
            <div class="i_col w_55">
              <p class="p_title">DESCRIPTION</p>
            </div>
            <div class="i_col w_15">
              <p class="p_title">PRICE</p>
            </div>
            <div class="i_col w_15">
              <p class="p_title">TOTAL</p>
            </div>
          </div>
        </div>
        <div class="i_table_body">
          @foreach($invoice->quotes as $quote)
              <div class="i_row">
                <div class="i_col w_15">
                  <p>{{ $quote->pivot->qty }}</p>
                </div>
                <div class="i_col w_55">
                  <p>{{ $quote->description }}</p>
                  <span>{{ $quote->pivot->description }}</span>
                </div>
                <div class="i_col w_15">
                  <p>${{ $quote->pivot->rate }}</p>
                </div>
                <div class="i_col w_15">
                  <p>${{ $quote->pivot->total }}</p>
                </div>
              </div>
          @endforeach
        </div>
        <div class="i_table_foot">
          <div class="i_row">
            <div class="i_col w_15">
              <p></p>
            </div>
            <div class="i_col w_55">
              <p></p>
            </div>
            <div class="i_col w_15">
              <p>Sub Total</p>
              <p>Tax 10%</p>
            </div>
            <div class="i_col w_15">
              <p>${{ $invoice->sub_total }}</p>
              <p>${{ $invoice->tax }}</p>
            </div>
          </div>
          <div class="i_row grand_total_wrap">
            <div class="i_col w_50">
            </div>
            <div class="i_col w_50 grand_total">
              <p><span>GRAND TOTAL:</span>
                <span>${{ $invoice->total }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="i_row">
        <div class="i_col w_50">
          <p class="p_title">Note to Customer: </p>
          <p>{{ $invoice->note }}</p>
        </div>
        <div class="i_col w_50 text_right">
          <p class="p_title">Terms and Conditions</p>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque, dicta distinctio! Laudantium voluptatibus est nemo.</p>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>