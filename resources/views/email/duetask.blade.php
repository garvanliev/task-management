<x-mail::message>
# Your are running out of time - {{$task->title}}

Date:

# {{$task->duedate}}



<x-mail::button :url="route('tasks.show', $task)">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
