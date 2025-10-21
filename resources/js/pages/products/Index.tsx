import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import { route } from 'ziggy-js';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Products',
    href: '/products',
  },
];

interface Product {
  id: number;
  name: string;
  category: string;
  description: string;
  price: number;
}

interface Props {
  products: Product[];
}

export default function Index({products}: Props) {
  const { processing, delete: destroy } = useForm();

  const handleDelete = (id: number, name: string) => {
    if(confirm(`Do you want to delete this product? id: ${id}; name: ${name}?`)) {
      destroy(route('products.destroy', id));
    }
  }

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <Head title="Products" />

      <div className="m-6">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-2xl font-semibold">Product List</h1>
          <Link href={route('products.create')}>
            <Button className='cursor-pointer'>
              Create New Product
            </Button>
          </Link>
        </div>

        <Table>
          <TableCaption>A list of all your products.</TableCaption>
          <TableHeader>
            <TableRow>
              <TableHead>ID</TableHead>
              <TableHead>Name</TableHead>
              <TableHead>Category</TableHead>
              <TableHead>Price</TableHead>
              <TableHead>Description</TableHead>
              <TableHead>Actions</TableHead>
            </TableRow>
          </TableHeader>

          <TableBody>
            {products.length > 0 ? (
              products.map((product) => (
                <TableRow key={product.id}>
                  <TableCell>{product.id}</TableCell>
                  <TableCell>{product.name}</TableCell>
                  <TableCell>{product.category}</TableCell>
                  <TableCell>
                    ₱{product.price.toLocaleString()}
                  </TableCell>
                  <TableCell>{product.description}</TableCell>
                  <TableCell className='text-center space-x-2'>
                    <Link href={route('products.edit', product.id)}>
                      <Button className='bg-slate-500 hover:bg-slate-700 cursor-pointer'>
                        Edit
                      </Button>
                    </Link>
                    <Button 
                      onClick={() => handleDelete(product.id, product.name)} 
                      className='bg-red-500 hover:bg-red-700 cursor-pointer' 
                      disabled={processing}>
                      Delete
                    </Button>
                  </TableCell>
                </TableRow>
              ))
            ) : (
              <TableRow>
                <TableCell
                  colSpan={5}
                  className="text-center py-4 text-gray-500"
                >
                  No products found.
                </TableCell>
              </TableRow>
            )}
          </TableBody>
        </Table>
      </div>
    </AppLayout>
  );
}

