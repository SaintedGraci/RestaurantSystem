<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // Display a listing of the menu items
    public function index()
    {
        $menuItems = MenuItem::paginate(10); // Use pagination for better UX
        return view('admin.manageUser.index_menu_items', compact('menuItems'));
    }

    // Show the form for creating a new menu item
    public function create()
    {
        return view('admin.manageUser.create_menu_item');
    }

    // Store a newly created menu item in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255', // Assuming you have a group name
            'price' => 'required|numeric',
            'link' => 'nullable|url', // Assuming you have a link field
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        } else {
            $imagePath = null; // Or set a default image path
        }

        MenuItem::create(array_merge($request->all(), ['image' => $imagePath]));

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item created successfully!');
    }

    // Show the form for editing the specified menu item
    public function edit($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return view('admin.manageUser.edit_menu_item', compact('menuItem'));
    }

    // Update the specified menu item in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'group_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menuItem = MenuItem::findOrFail($id);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if necessary
            if ($menuItem->image) {
                \Storage::disk('public')->delete($menuItem->image);
            }
            $imagePath = $request->file('image')->store('menu_images', 'public');
        } else {
            $imagePath = $menuItem->image; // Keep the old image if no new one is uploaded
        }

        $menuItem->update(array_merge($request->all(), ['image' => $imagePath]));

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item updated successfully!');
    }

    // Remove the specified menu item from storage
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        
        // Delete the image if it exists
        if ($menuItem->image) {
            \Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->delete();

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item deleted successfully!');
    }
}