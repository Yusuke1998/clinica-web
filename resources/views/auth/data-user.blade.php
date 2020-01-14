@auth
<script>
	const global = this;
	global.user = @json(auth()->user());
	global.person = @json(auth()->user()->person);
	global.dni = @json(auth()->user()->dni());
	global.is_admin = @json(auth()->user()->is_admin());
</script>
@endauth