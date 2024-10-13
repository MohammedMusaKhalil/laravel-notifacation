<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="mt-1 block w-full">
                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="personality" :value="__('Personality')" />
            <x-text-input id="personality" name="personality" type="text" class="mt-1 block w-full" :value="old('personality', $user->personality)" />
            <x-input-error class="mt-2" :messages="$errors->get('personality')" />
        </div>

        <div>
            <x-input-label for="zodiac_sign_id" :value="__('Zodiac Sign')" />
            <select id="zodiac_sign_id" name="zodiac_sign_id" class="mt-1 block w-full">
                @foreach($zodiacSigns as $zodiacSign)
                    <option value="{{ $zodiacSign->id }}" {{ old('zodiac_sign_id', $user->zodiac_sign_id) == $zodiacSign->id ? 'selected' : '' }}>{{ $zodiacSign->zodiacn }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('zodiac_sign_id')" />
        </div>

        {{-- <div>
            <x-input-label for="hobbie_id" :value="__('Hobbies')" />
            <select id="hobbie_id" name="hobbie_id" class="mt-1 block w-full">
                @foreach($hobbies as $hobby)
                    <option value="{{ $hobby->id }}" {{ old('hobbie_id', $user->hobbie_id) == $hobby->id ? 'selected' : '' }}>{{ $hobby->hobby_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('zodiac_sign_id')" />
        </div> --}}

        {{-- <div>
            <x-input-label for="favorite_color_id" :value="__('Favorite Colors')" />
            <select id="favorite_color_id" name="favorite_color_id" class="mt-1 block w-full">
                @foreach($favorite_colors as $favorite_color)
                    <option value="{{ $favorite_color->id }}" {{ old('favorite_color_id', $user->favorite_color_id) == $favorite_color->id ? 'selected' : '' }}>{{ $favorite_color->color_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('zodiac_sign_id')" />
        </div> --}}

        {{-- <div>
            <x-input-label for="favorite_book_id" :value="__('Favorite Books')" />
            <select id="favorite_book_id" name="favorite_book_id" class="mt-1 block w-full">
                @foreach($favorite_books as $favorite_book)
                    <option value="{{ $favorite_book->id  }}" {{ old('favorite_book_id', $user->favorite_book_id) == $favorite_book->id ? 'selected' : '' }}>{{ $favorite_book->book_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('zodiac_sign_id')" />
        </div> --}}

        {{-- <div>
            <x-input-label for="favorite_music_id" :value="__('Favorite Music')" />
            <select id="favorite_music_id" name="favorite_music_id" class="mt-1 block w-full">
                @foreach($favorite_music as $music)
                    <option value="{{  $music->id  }}" {{ old('favorite_music_id', $user->favorite_music_id) == $music->id ? 'selected' : '' }}>{{ $music->music_genre }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('zodiac_sign_id')" />
        </div> --}}
        <div>
            <x-input-label for="language_id" :value="__('Language')" />
            <select id="language_id" name="language_id" class="mt-1 block w-full">
                @foreach($languages as $lang)
                    <option value="{{  $lang->id  }}" {{ old('language_id', $user->language_id) == $lang->id ? 'selected' : '' }}>
                        {{ $lang->language }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('language_id')" />
        </div>
        {{-- <div>
            <x-input-label for="other_interest_id" :value="__('Other Interests')" />
            <select id="other_interest_id" name="other_interest_id" class="mt-1 block w-full" >
                @foreach($other_interests as $other_interest)
                    <option value="{{ $other_interest->id }}" {{ old('other_interest_id', $user->other_interest_id) == $other_interest->id ? 'selected' : '' }}>{{ $other_interest->interest_name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('other_interest_id')" />
        </div> --}}
        <div>
            <x-input-label for="hobbies" :value="__('Hobbies')" />
            @foreach($hobbies as $hobby)
                <div>
                    <input type="checkbox" id="hobby_{{ $hobby->id }}" name="hobbies[]" value="{{ $hobby->id }}"
                           {{ in_array($hobby->id, old('hobbies', $user->hobbies->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="hobby_{{ $hobby->id }}">{{ $hobby->hobby_name }}</label>
                </div>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('hobbies')" />
        </div>

        <div>
            <x-input-label for="favorite_colors" :value="__('Favorite Colors')" />
            @foreach($favorite_colors as $color)
                <div>
                    <input type="checkbox" id="color_{{ $color->id }}" name="favorite_colors[]" value="{{ $color->id }}"
                           {{ in_array($color->id, old('favorite_colors', $user->favoriteColors->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="color_{{ $color->id }}">{{ $color->color_name }}</label>
                </div>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('favorite_colors')" />
        </div>

        <div>
            <x-input-label for="favorite_books" :value="__('Favorite Books')" />
            @foreach($favorite_books as $book)
                <div>
                    <input type="checkbox" id="book_{{ $book->id }}" name="favorite_books[]" value="{{ $book->id }}"
                           {{ in_array($book->id, old('favorite_books', $user->favoriteBooks->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="book_{{ $book->id }}">{{ $book->book_name }}</label>
                </div>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('favorite_books')" />
        </div>

        <div>
            <x-input-label for="favorite_music" :value="__('Favorite Music')" />
            @foreach($favorite_music as $music)
                <div>
                    <input type="checkbox" id="music_{{ $music->id }}" name="favorite_music[]" value="{{ $music->id }}"
                           {{ in_array($music->id, old('favorite_music', $user->favoriteMusic->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="music_{{ $music->id }}">{{ $music->music_genre }}</label>
                </div>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('favorite_music')" />
        </div>

        <div>
            <x-input-label for="other_interests" :value="__('Other Interests')" />
            @foreach($other_interests as $interest)
                <div>
                    <input type="checkbox" id="interest_{{ $interest->id }}" name="other_interests[]" value="{{ $interest->id }}"
                           {{ in_array($interest->id, old('other_interests', $user->otherInterests->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="interest_{{ $interest->id }}">{{ $interest->interest_name }}</label>
                </div>
            @endforeach
            <x-input-error class="mt-2" :messages="$errors->get('other_interests')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
