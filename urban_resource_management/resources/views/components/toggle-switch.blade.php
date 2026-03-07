<div class="d-flex align-items-center gap-3">

    <input
        type="hidden"
        name="{{ $name }}"
        value="{{ \App\Domain\Enums\StatusEnum::INACTIVE }}"
    >

    <label class="toggle-container">

        <input
            type="checkbox"
            name="{{ $name }}"
            value="1"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
        >

        <span class="toggle">
            <span class="circle"></span>
        </span>

    </label>

    <span class="toggle-label">
        {{ $checked ? $checkedLabel : $uncheckedLabel }}
    </span>

</div>
