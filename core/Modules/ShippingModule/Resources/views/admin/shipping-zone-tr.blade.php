@php
    $states = DB::table('states')->where('country_id', 31)->get();
@endphp

@if(isset($zoneCountry))
    <tr>
        <td style="width: 30%">
            <select class="form-control" name="country[]">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ $zoneCountry?->id == $country->id ? "selected" : "" }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td style="width: 60%">
            <select class="form-control select2 select-two-{{ $rand }}" name="states[{{ $zoneCountry?->id ?? "" }}][]"
                id="states_select" multiple>
                @if(isset($zoneCountry?->states))
                    @foreach($zoneCountry?->states ?? [] as $state)
                        <option value="{{ $state->id }}" {{ in_array($state?->id, $zoneCountry->zoneStates->pluck("id")->toArray()) && !empty($zoneCountry) ? "selected" : "" }}>{{ $state->name }}</option>
                    @endforeach
                @endif
            </select>
        </td>
        <td style="width: 10%">
            <button type="button" id="shipping_zone_minus_btn" class="btn btn-danger btn-sm">
                <i class="las la-minus"></i>
            </button>
            <button type="button" id="shipping_zone_plus_btn" data-select-two="{{$rand}}" class="btn btn-info btn-sm">
                <i class="las la-plus"></i>
            </button>
        </td>
    </tr>
@else
    <tr>
        <td style="width: 30%">
            <select class="form-control" name="country[]">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td style="width: 60%">
            <select class="form-control select2 select-two-{{ $rand }}" name="states[][]" multiple id="states_select">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </td>
        <td style="width: 10%">
            <button type="button" id="shipping_zone_minus_btn" class="btn btn-danger btn-sm">
                <i class="las la-minus"></i>
            </button>
            <button type="button" id="shipping_zone_plus_btn" data-select-two="{{$rand}}" class="btn btn-info btn-sm">
                <i class="las la-plus"></i>
            </button>
        </td>
    </tr>
@endif