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
                    <a href="{{ route('todos.index') }}">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">戻る</button>
                    </a>
                    <table class="table-auto my-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">TODO</th>
                                <th class="border px-4 py-2">期限</th>
                                <th class="border px-4 py-2">完了日</th>
                                <th class="border px-4 py-2">作成日</th>
                                <th class="border px-4 py-2">更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">{{ $todo->id }}</td>
                                <td class="border px-4 py-2">{{ $todo->title }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('todos.updateDeadline', ['id' => $todo->id])}}" method="POST">
                                        @csrf
                                        <input type="date" name="deadline" value="{{ $todo->deadlines->last()->deadline->format('Y-m-d') }}" />
                                        <input type="submit" value="変更" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" />
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
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ $todo->content }}</p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>期限変更履歴</h3>
                    <table class="table-auto my-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">期限</th>
                                <th class="border px-4 py-2">設定日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todo->deadlines->sortByDesc('created_at') as $deadline)
                            <tr>
                                <td class="border px-4 py-2">{{ $deadline->deadline->format('Y年m月d日') }}</td>
                                <td class="border px-4 py-2">{{ $deadline->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>完了履歴</h3>
                    <table class="table-auto my-4">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">状態</th>
                                <th class="border px-4 py-2">設定日</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todo->dones->sortByDesc('created_at') as $done)
                            <tr>
                                <td class="border px-4 py-2">{{ $done->is_done ? '完了' : '未完了' }}</td>
                                <td class="border px-4 py-2">{{ $done->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>