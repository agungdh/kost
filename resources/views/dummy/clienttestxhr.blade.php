<!DOCTYPE html>
<html>
<head>
	<title>Hello, World!</title>
</head>
<body>

</body>

<script src="{{ asset('assets') }}/axios/axios.min.js"></script>
<script>
axios.post("{{ route('dummy.testXhr') }}", {
	nama : 'AgungDH',
	nama2 : 'AgungDH2',
	nama3 : 'AgungDH3',
	_method : 'PUT',
})
.then(function (res) {
  console.log(res.data);
})
.catch(function (err) {
  console.log(err.message);
});
</script>
</html>