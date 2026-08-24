<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Product::with('category');

        if (!empty($this->filters['search'])) {
            $query->where('name', 'like', '%' . $this->filters['search'] . '%');
        }

        if (!empty($this->filters['category_id'])) {
            $query->where('category_id', $this->filters['category_id']);
        }

        if (isset($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        return $query->get()->map(function ($product) {
            return [
                'ID' => $product->id,
                'Name' => $product->name,
                'Price' => $product->price,
                'Category' => $product->category->name ?? '',
                'Status' => $product->status ? 'Active' : 'Inactive',
                'Description' => $product->description,
                'Created At' => $product->created_at ? $product->created_at->toDateString() : '',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Price', 'Category', 'Status', 'Description', 'Created At'];
    }
}
