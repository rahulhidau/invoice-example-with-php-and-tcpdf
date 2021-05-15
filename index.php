<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!--bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!--bootstrap-->
	<link rel="stylesheet" href="custom.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
<title>Invoice with TCPDF</title>
</head>

<body>

	<div class="main-form">
		<h1 class="text-uppercase"><strong>Generate invoice with php and TCPDF</strong></h1>
		<form id="invoice">
			<input type="hidden" name="action" value="pdf"/>
			<div class="row">
				<div class="col-md-7">
					<label class="my-label">Customer name</label>
					<input type="text" name="customer" placeholder="Name" class="form-control"/>
					</div><!--col-->
				<div class="col-md-5">
					<label class="my-label">Invoice number</label>
					<input type="text" name="in" placeholder="000" class="form-control"/>
					</div><!--col-->
				<div class="col-md-12">
					<label class="my-label">Customer address</label>
					<textarea name="address" class="form-control" placeholder="Include phone and email here if any"></textarea>
					</div><!--col-->
				<div class="col-md-12">
					
				<div class="row clone">
				<div class="col-md-4">
					<label class="my-label">Item name</label>
					<input type="text" name="name[]" class="form-control" placeholder="Item name"/>
					</div><!--col-->
				<div class="col-md-4">
					<label class="my-label">Item Price</label>
					<input type="text" name="price[]" class="form-control" placeholder="99.99"/>
					</div><!--col-->
				<div class="col-md-4">
					<label class="my-label">Quantity</label>
					<input type="number" name="qty[]" class="form-control" placeholder="1"/>
					</div><!--col-->
					</div><!--row clone-->
					<div id="append"></div><!--append-->
					<a href="javascript:;" id="cloner" class="text-right">+More</a>
					</div><!--col-->
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary btn-block" onClick="submitForm('#invoice')">Generate PDF</button>
					</div><!--col-->
				</div><!--row-->
			</form><!--form-->
		<div class="output"></div>
		</div><!--main-form-->

<script src="custom.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>