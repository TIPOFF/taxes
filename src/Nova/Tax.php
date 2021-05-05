<?php

declare(strict_types=1);

namespace Tipoff\Taxes\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Tipoff\Locations\Nova\Location;
use Tipoff\Support\Nova\BaseResource;
use Tipoff\Taxes\Enum\TaxCode;
use Tipoff\Taxes\Models\Tax as TaxModel;

class Tax extends BaseResource
{
    public static $model = TaxModel::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name',
        'title',
    ];

    public static $group = 'Operations Units';

    public function fieldsForIndex(NovaRequest $request)
    {
        return array_filter([
            ID::make()->sortable(),
            Number::make('Percent'),
            Text::make('Name')->sortable(),
            Text::make('Tax Code')->sortable(),
        ]);
    }

    public function fields(Request $request)
    {
        return array_filter([
            Text::make('Name')->rules('required')->creationRules('unique:taxes,name')->updateRules('unique:taxes,name,{{resourceId}}'),
            Slug::make('Slug')->from('Name')->rules('required')->creationRules('unique:taxes,slug')->updateRules('unique:taxes,slug,{{resourceId}}'),
            Number::make('Percent')->rules('required'),
            Text::make('Title')->rules('required'),
            Select::make('Tax Code')->options([
                TaxCode::BOOKING => 'Booking',
                TaxCode::PRODUCT => 'Product',
            ])->rules('required'),

            new Panel('Data Fields', $this->dataFields()),

            BelongsTo::make('Location', 'location', Location::class),
            nova('booking') ? HasMany::make('Bookings', 'bookings', nova('booking')) : null,
        ]);
    }

    protected function dataFields(): array
    {
        return array_merge(
            parent::dataFields(),
            $this->creatorDataFields(),
        );
    }

    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $location_id = $request->post('location');
        $unique = Rule::unique('taxes', 'tax_code')->where(
            'location_id',
            $location_id
        );

        if ($request->route('resourceId')) {
            $unique->ignore($request->route('resourceId'));
        }

        $uniqueValidator = Validator::make($request->only('tax_code'), [
            'tax_code' => [$unique],
        ]);

        if ($uniqueValidator->fails()) {
            $validator
                ->errors()
                ->add(
                    'tax_code',
                    'Tax Code is already taken with this Location option'
                );
        }
    }
}
