<x-app-layout>
    <style>
    .note__area {
      padding: 80px 20px 20px 20px;
      background-image: linear-gradient(to top, #fbc2eb 0%, #a6c1ee 100%);
      display: flex;
      flex-direction: row-reverse;
      gap: 20px;
    }

    .note__box,
    .note__box-tags,
    .note__box-memos {
      background-color: #fff;
      box-shadow: rgba(17, 12, 46, 0.2) 0px 48px 100px 0px;
      border-radius: 10px;
      overflow: hidden;
    }

    .note__box {
      width: 60%;
      border: 4px solid #a6a6a6;
    }

    .note__area--bottom {
      width: 40%;
    }

    .note__box-memos {
      margin-top: 20px;
      min-height: 500px;
    }

    .note--title {
      background-color: antiquewhite;
      padding: 20px;
      font-weight: bold;
      font-size: 18px;
    }

    .note--title a {
      text-align: right;
      margin-left: 40px;
      color: rgba(59 130 246 / 0.5);
    }

    .note--title span {
      font-size: small;
      font-weight: normal;
    }

    .note__box--memo textarea {
      width: 100%;
      border: none;
    }

    .note__box--tag,
    .note__box--btn {
      padding: 20px;
    }

    .note__box--tag {
      border-bottom: 4px dotted antiquewhite;
      margin-bottom: 10px;
      padding: 10px 20px;
    }

    .memo--title {
      margin: 20px;
    }

    .memo--textarea {
      border-radius: 4px;
      border: 4px solid antiquewhite;
      margin: 0 20px;
    }

    .note__box-memos ul li {
      display: flex;
      border-bottom: 1px dotted #888;
      justify-content: space-between;
      margin: 16px;
    }

    .memo-list {
      display: block;
      width: 200px;
    }

    .updated {
      margin-left: 0px;
    }

    .validation {
      padding: 20px;
    }

    .tag-lists {
      padding: 20px;
      font-size: 20px;
    }

    .tag-lists ul {
      display: flex;
      justify-content: center;
      gap: 16px;
    }

    .tag-lists li {
      margin-top: 20px;
      width: 100px;
    }

    .tag-lists a {
      display: block;
      border: 4px solid #dac495;
      border-radius: 10px 0 0 0;
      background-color: #fff9eb;
      padding: 10px 16px;
      text-align: center;
    }

    .edit_tag-page--top {
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }

    .edit_tag-page--top a {
      background-color: #fff;
      padding: 20px 24px;
      background-color: antiquewhite;
      border-right: 2px solid #888;
      border-bottom: 2px solid #888;
      border-radius: 4px;
    }

    .tag-lists__bottom {
      margin-top: 80px;
      display: inline-block;
    }

    .tag-lists__bottom a {
      border: 2px solid #888;
      border-radius: 8px 8px 0 0;
      background-color: #ebebeb;
      padding: 10px 10px 0;
    }

    .tag-lists--img {
      width: 52px;
      margin: -10px auto 0;
    }

    .gomibako form button {
      display: flex;
      align-items: center;
      color: #1149a6;
    }

    .gomibako-img {
      width: 32px;
    }

    .pagination {
      margin: 32px 16px 16px;
    }

    .dust_itemP--list .done-btn a {
      display: flex;
    }

    .return__item-btn {
      margin-right: 24px;
      color: #1149a6;
    }

    .updated {
      font-size: 14px;
      padding-top: 6px;
    }

    @media (max-width:1000px) {
      .note__area {
        flex-direction: column;
      }

      .note__box,
      .note__area--bottom {
        width: 100%;
      }
    }

    @media (max-width:420px) {
      .note__area {
        padding: 40px 8px;
      }

      .tag-lists ul {
        flex-direction: column;
        align-items: center;
      }

      .tag-lists li {
        width: 200px;
      }

      .updated {
        display: none;
      }
    }
  </style>
  <section class="note__area">

    <div class="note__box">

      <form action="{{ route('notes.store') }}" method="post">
        @csrf

        <input type="hidden" name="user_id" value="{{ $user['id'] }}">
        <div class="note__box--memo">
          <p class="note--title">新しく作成！</p>


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
            <input type="text" name="title" id="title" value="{{ old('title') }}" style="border-radius: 4px; border:4px solid antiquewhite;">
          </div>
          <div class="memo--textarea">
            <textarea name="content" id="content" value="" cols="100%" rows="10" placeholder="メモを書く">{{ old('content') }}</textarea>
          </div>
        </div>

        <div class="note__box--tag">
          <label class="leading-7 text-sm text-gray-600">タグ</label><br>
          <select name="tag_id">
            <option value="">選択してください</option>
            <option value="1" {{ old('tag_id')==1 ? 'selected' : '' }}>仕事</option>
            <option value="2" {{ old('tag_id')==2 ? 'selected' : '' }}>遊び</option>
            <option value="3" {{ old('tag_id')==3 ? 'selected' : '' }}>その他</option>
          </select>
        </div>

        <div class="note__box--btn">
          <button name="create_btn" value="create!" class="text-white bg-pink-600 border-0 py-2 px-8 focus:outline-none hover:bg-red-700 rounded text-lg">保存する！</button>
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
        <p class="note--title">ゴミ箱のメモ一覧 <span>(選択すると完全削除するよ！)</span></p>
        <ul>
          @foreach($memos as $memo)
          <li class="dust_itemP--list">

            <form action="{{ route('notes.destroy' , ['id' => $memo->id]) }}" method="post" id="delete_{{ $memo->id }}">
              @csrf
              <div class="done-btn">
                <a class="text-blue-400" href="#" data-id="{{ $memo->id }}" onclick="deletePost(this)">
                  <span class="done-btn-coment">
                    ・{{ $memo['title'] }}
                  </span>
                </a>
              </div>
            </form>

            <div class="gomibako" style="opacity:0;cursor:none;pointer-events:none;">
              <form action="" method="">
                  @csrf
                  <button name="dust_item" value="">
                    <div class="gomibako-img">
                      <img src="{{ asset('storage/gomibako.png') }}" alt="">
                    </div>
                    DONE！
                  </button>
                </form>
            </div>

            <form action="{{ route('notes.back' , ['id' => $memo->id] ) }}" method="post">
              @csrf
              <div class="return__item-btn">
                <button>復元する！</button>
              </div>
            </form>
          </li>
          @endforeach

        </ul>

        <div class="pagination">
          {{ $memos-> links(); }}
        </div>
      </div>
    </div>
  </section>

  <script>
    function deletePost(e) {
      'use strict'
      if (confirm('削除していいですか？？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
      }
    }
  </script>
</x-app-layout>