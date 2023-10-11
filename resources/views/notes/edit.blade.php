<x-app-layout>
  <section class="note__area">
    <div class="note__box">

      <form action="{{ route('notes.update' , ['id' => $memo->id] ) }}" method="post">
        @csrf

        <input type="hidden" name="user_id" value="{{ $user['id'] }}">
        <div class="note__box--memo">
          <p class="note--title">メモの内容 <span>(編集する場合は書き込んでね)</span></p>

          <!-- バリデーションメッセージ -->
          @if($errors->any())
          <div class="validation">
            <ul class="font-medium text-red-600">
              @foreach($errors -> all() as $error)
              <li>・{{$error}}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="memo--title">
            <label for="title">題名</label>
            <input type="text" name="title" id="title" value="{{ $memo['title'] }}" style="border-radius: 4px; border:4px solid antiquewhite;">
          </div>
          <div class="memo--textarea">
            <textarea name="content" id="content" value="" cols="100%" rows="12" placeholder="メモを書く">{{ $memo['content'] }}</textarea>
          </div>
        </div>

        <div class="note__box--tag">
          <label class="leading-7 text-sm text-gray-600">タグ</label><br>
          <select name="tag_id">
            <option value="">選択してください</option>
            <option value="1" @if($memo->tag_id === 1) selected @endif {{ old('tag_id')==1 ? 'selected' : '' }}>仕事</option>
            <option value="2" @if($memo->tag_id === 2) selected @endif {{ old('tag_id')==2 ? 'selected' : '' }}>遊び</option>
            <option value="3" @if($memo->tag_id === 3) selected @endif {{ old('tag_id')==3 ? 'selected' : '' }}>その他</option>
          </select>
        </div>

        <div class="note__box--btn">
          <button class="text-white bg-pink-600 border-0 py-2 px-8 focus:outline-none hover:bg-red-700 rounded text-lg">更新する</button>
        </div>

      </form>

      <form action="{{ route('notes.edit_page_dust' , $editP_id) }}" method="post" style="margin-top: -64px;">
        @csrf
        <div class="editP-donesBtn-block">
          <div class="editP-donesBtn">
            <button>
              <div class="tag-lists--img">
                <img src="{{ asset('storage/gomibako.png') }}" alt="">
              </div>
              DONE！
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="note__area--bottom">
      <div class="note__box-tags">
        <p class="note--title">タグから選ぶ？ <a href="{{ route('notes.index') }}">全タグ表示！</a></p>
        <div class="tag-lists text-blue-400">
          <ul>
            <li>
              <a href="{{ route('notes.edit_tag',1) }}">仕事</a>
            </li>
            <li>
              <a href="{{ route('notes.edit_tag',2) }}">遊び</a>
            </li>
            <li>
              <a href="{{ route('notes.edit_tag',3) }}">その他</a>
            </li>
          </ul>

          <div class="tag-lists__bottom">
            <a href="{{ route('notes.dust_item') }}">
              ゴミ箱を見る
              <div class="tag-lists--img">
                <img src="{{ asset('storage/me.png') }}" alt="">
              </div>
            </a>
          </div>
        </div>
      </div>

      <div class="note__box-memos">
        <p class="note--title">メモ一覧 <span>(選択すると内容の確認と編集ができるよ)</span></p>
        <ul>
          @foreach($memos as $key)
          <li>
            <a class="text-blue-400 memo-list" href="{{ route('notes.edit',['id' => $key->id]) }}">
              ・{{ $key['title'] }}
            </a>
            <div class="updated">
              <span>更新日：{{ $key['updated_at'] }}</span>
            </div>

            <div class="gomibako" style="opacity: 0;pointer-events:none;">
              <form action="{{ route('notes.dust' , ['id' => $key->id]) }}" method="post">
                @csrf
                <button name="dust_item" value="{{ $key->status }}">
                  <div class="gomibako-img">
                    <img src="{{ asset('storage/gomibako.png') }}" alt="">
                  </div>
                  DONE！
                </button>
              </form>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="pagination">
          {{ $memos -> links(); }}
        </div>
      </div>
    </div>
  </section>

</x-app-layout>