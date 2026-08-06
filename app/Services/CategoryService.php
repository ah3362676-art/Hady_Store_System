<?php

namespace App\Services;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function create(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        return $this->categoryRepository->create($data);
    }

    public function update(Category $category, array $data): bool
    {
        return $this->categoryRepository->update($category, $data);
    }

    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
