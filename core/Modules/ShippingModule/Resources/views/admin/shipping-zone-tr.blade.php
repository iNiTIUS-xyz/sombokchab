@php
    $states = DB::table('states')->where('country_id', 31)->get();
@endphp

@if(isset($zoneCountry))
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
            <select class="form-control select-two-{{ $rand }}" name="states[{{ $zoneCountry?->id ?? "" }}]">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}" @if($zoneCountry->state_id == $state->id) selected @endif>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td style="width: 10%">
            <button type="button" id="shipping_zone_minus_btn" class="btn btn-danger btn-sm">
                <i class="las la-minus"></i>
            </button>
            <button type="button" id="shipping_zone_plus_btn" data-select-two="{{$rand}}" class="btn btn-primary btn-sm">
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
            <select class="form-control select-two-{{ $rand ?? 99999 }}" name="states[]">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td style="width: 10%">
            <button type="button" id="shipping_zone_minus_btn" class="btn btn-danger btn-sm">
                <i class="las la-minus"></i>
            </button>
            <button type="button" id="shipping_zone_plus_btn" data-select-two="{{$rand ?? 99999}}"
                class="btn btn-primary btn-sm">
                <i class="las la-plus"></i>
            </button>
        </td>
    </tr>
@endif