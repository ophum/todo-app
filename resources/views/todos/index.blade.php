<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('todos.store')}}" method="POST">
                        @csrf
                        <label>TODO</label>
                        <br />
                        <input type="text" name="title" />
                        <br />
                        <label>説明</label>
                        <br />
                        <textarea name="content"></textarea>
                        <br />
                        <label>期限</label>
                        <br />
                        <input type="date" name="deadline" />
                        <br />
                        <input class="btn w-96" type="submit" value="登録" />
                    </form>
                    <table class="table-auto my-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2"></th>
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">TODO</th>
                                <th class="border px-4 py-2">期限</th>
                                <th class="border px-4 py-2">完了日</th>
                                <th class="border px-4 py-2">作成日</th>
                                <th class="border px-4 py-2">更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)
                            <tr>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('todos.show', ['id' => $todo->id])}}">
                                        <button class="btn">開く</button>
                                    </a>
                                </td>
                                <td class="border px-4 py-2">{{ $todo->id }}</td>
                                <td class="border px-4 py-2">{{ $todo->title }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('todos.updateDeadline', ['id' => $todo->id])}}" method="POST">
                                        @csrf
                                        <input type="date" name="deadline" value="{{ $todo->deadlines->last()->deadline->format('Y-m-d') }}" />
                                        <input type="submit" value="変更" />
                                    </form>
                                    @if($todo->deadlines->count() > 1)
                                    <p>{{ $todo->deadlines->count() - 1 }}回変更されています。</p>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('todos.updateDone', ['id' => $todo->id, 'is_done' => !($todo->dones->count() > 0 && $todo->dones->last()->is_done) ])}}" method="POST">
                                        @csrf
                                        <button type="submit">
                                            <input type="checkbox" @if($todo->dones->count() > 0 && $todo->dones->last()->is_done) checked @endif />
                                        </button>
                                    </form>
                                    @if ($todo->dones->last()->is_done )
                                    {{ $todo->dones->last()->created_at->format('Y年m月d日') }}
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $todo->created_at }}</td>
                                <td class="border px-4 py-2">{{ $todo->updated_at}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>