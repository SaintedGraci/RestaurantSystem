<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group_name' => ['required', 'string', 'in:Main Course,Dessert,Drink,Appetizer,Side Dish'],
            'link' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        MenuItem::create([
            'name' => $validated['name'],
            'group_name' => $validated['group_name'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Menu item added successfully!');
    }

    public function edit(int $id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('admin.manageUser.partials.edit_menu_item', compact('menuItem'));
    }

    public function update(Request $request, int $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group_name' => ['required', 'string', 'in:Main Course,Dessert,Drink,Appetizer,Side Dish'],
            'link' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        $imagePath = $menuItem->image; // Keep existing image path by default

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $imagePath = $request->file('image')->store('menu_images', 'public');
        } elseif ($request->boolean('remove_image')) {
            // Remove image if checkbox is ticked
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $imagePath = null;
        }

        $menuItem->update([
            'name' => $validated['name'],
            'group_name' => $validated['group_name'],
            'link' => $validated['link'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.menu-items.index')->with('status', 'Menu item updated successfully!');
    }

    public function destroy(int $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->delete();

        return redirect()->route('admin.menu-items.index')->with('status', 'Menu item deleted successfully!');
    }
}
