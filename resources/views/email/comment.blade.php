<x-mail::message>
# New comment was made on {{$task->title}}

Comment:

# {{$comment->description}}



<x-mail::button :url="route('tasks.show', $task)">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
