	<li>
		<?php $q = $notification->data['question']['id_post']*1000; ?>
		<a href='{{ url("user/notification/question/{$q}") }}'>
			{{ $notification->data['user']['name'] }} a répondu à votre question <strong>{{ $notification->data['question']['titre_post'] }}</strong>
		</a>
		<small class="pull-right">{{$notification->created_at->diffForHumans() }}</small>
	</li>
	<hr>
