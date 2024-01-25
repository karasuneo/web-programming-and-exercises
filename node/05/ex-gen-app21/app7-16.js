
model User {
  id Int @id @default(autoincrement())
  name String @unique
  pass String
  mail String?
  age Int @default(0)
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt
  markdata Markdata[]
}




